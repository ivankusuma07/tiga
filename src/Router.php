<?php
namespace Lotus\Framework;
use Lotus\Framework\Facade\RoutesFacade as Route;
use Lotus\Framework\Facade\ViewFacade as View;
use Lotus\Framework\Facade\RequestFacade as Request;
use Lotus\Framework\Exception\RoutingException as RoutingException;
use FastRoute\Dispatcher as Dispatcher;
use FastRoute\RouteCollector as RouteCollector;

class Router {

	protected $dispatcher;

	protected $routeInfo;

	protected $routes;

	protected $currentURL;

	function init() {

		$this->routes = Route::getRouteCollections();
		
		$this->dispatcher = $this->createDispatcher();

		$this->currentURL = Request::getPathInfo();

		$this->dispatch(); 

	}

	protected function createDispatcher()
    {
        return \FastRoute\simpleDispatcher(function ($r) {
            foreach ($this->routes as $route) {

                $r->addRoute($route->getMethod(), $route->getConvertedRoute(), $route->getHandler());
            
            }
        });
    }

    protected function dispatch() {

    	$routeInfo = $this->dispatcher->dispatch($_SERVER['REQUEST_METHOD'],$this->currentURL);

		switch ($routeInfo[0]) {
		    case Dispatcher::NOT_FOUND:
		        // ... 404 Not Found

		    	// var_dump($routeInfo[0]);

		        break;
		    case Dispatcher::METHOD_NOT_ALLOWED:
		        $allowedMethods = $routeInfo[1];
		        // ... 405 Method Not Allowed
		        break;
		    case Dispatcher::FOUND:

		        $handler = $routeInfo[1];
		        $vars = $routeInfo[2];

		        // Start buffering
		        ob_start();
		        
		        // Handle request
		        $this->handle($handler,$vars);
		        
		        //Transfer buffer to view
		        $content = ob_get_contents();
		        ob_end_clean();
		        
		        View::setBuffer($content);

		        

		        // Exit WordPress or not to exist after Lotus finish executing
		       

		        break;
		}

    }

    protected function handle($handler,$vars) {

    	if (is_callable($handler))
        {
            // The action is an anonymous function, let's execute it.
            call_user_func_array($handler, $vars);

            return true;
        }
        else if (is_string($handler) )
        {

            //set default method to index
            if(!strpos($handler,'@'))
                $handler = $handler."@index";
    
            list($controller, $method) = explode('@', $handler);

            $class = basename($controller);
       
            // The controller class was still not found. Let the next routes handle the
            // request.
            if (!class_exists($class))
               throw new RoutingException("{$class} not found");


            // @TODO, pass constructor parameters functions
            $instance = new $class();

            //check method exist
            if(!method_exists($instance, $method))
                throw new RoutingException("{$class} does'nt have method {$method}");

            call_user_func_array(array($instance, $method), $vars);

            return true;
        }
        
    }


	protected function hash($routes) {

	} 

	protected function addWPRewriteRules() {

		$routes = Route::getRouteCollections();

		//@todo : HTTP Method separation
		//@todo : Rewrite for WP

		// foreach ($rules as $rule) {

		// 	add_rewrite_rule($rule['regex'],$rule['redirect'],'top');
		// }

	}



}

