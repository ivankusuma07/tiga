<?php
namespace Tiga\Framework;
use Tonjoo\Almari\Container as Container;
use Tiga\Framework\Facade\RouterFacade as Router;
use Tiga\Framework\Console\Console as Console;

class App extends Container
{
	function routerInit() {

		Router::init();
	}

	function getConsole() {
		return new Console();
	}

	function registerWhoops() {
		// Load Whoops Only in Debug Mode
		if(TIGA_DEBUG==true) {
			// @todo Load Whoops only in debug mode 
			$whoops = new \Whoops\Run();
			$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
			 
			// Set Whoops as the default error and exception handler used by PHP:
			$whoops->register();  
		}
	}
}