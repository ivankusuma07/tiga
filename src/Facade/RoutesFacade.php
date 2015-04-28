<?php
namespace Lotus\Framework\Facade;

use Lotus\Framework\Facade\Facade as Facade;

class RoutesFacade extends Facade{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    
     public static function getFacadeAccessor() { 
     	
     	return 'routes';

     }
}