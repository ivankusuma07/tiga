<?php 

namespace Tiga\Framework;

class Route{

	/**
	 * Method of the request
	 */
	private $method;

	/**
	 * Route 
	 */
	private $route;
	/**
	 * Handler
	 */

	private $handler;
    /**
     * Run Level
     */
    
    private $runLevel;


	public function __construct($method,$route,$handler){

		$this->method = $method;

		$this->route = $route;

		$this->handler = $handler;
	}


    /**
     * Gets the Method of the request.
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Sets the Method of the request.
     *
     * @param mixed $method the method
     *
     * @return self
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Gets the Route.
     *
     * @return mixed
     */
    public function getRoute()
    {

        return $this->route;
    }
    
    /**
     * Gets the Converted Route.
     *
     * @return mixed
     */
    public function getConvertedRoute()
    {

        return $this->convertRouteParam($this->route);
    }
    
    /**
     * Sets the Route.
     *
     * @param mixed $route the route
     *
     * @return self
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Gets the Handler.
     *
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }
    
    /**
     * Sets the Handler.
     *
     * @param mixed $handler the handler
     *
     * @return self
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;

        return $this;
    }

    public function convertRouteParam($route) 
    {

        $patterns = array(
            ':num' => ':[0-9]+', 
            ':any' => ':[a-zA-Z0-9\.\-_%=]+', 
            ':all' => ':.*', 
            // '@num?' => '?:/([0-9]+)?', 
            // '/@any?' => '?:/([a-zA-Z0-9\.\-_%=]+)?', 
            // '/:all?' => '?:/(.*)?'
        );

        $route = str_replace(array_keys($patterns), array_values($patterns), $route);

        return $route;
    }
}