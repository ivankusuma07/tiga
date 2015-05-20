<?php
namespace Tiga\Framework\Facade;

abstract class Facade {

    /**
     * The container for facaded class
     */
     static $container;

    /**
     * Set the container instance
     */
    public static function setFacadeContainer($container)
    {
        static::$container = $container;
    }

    /*
     * Provided by the concrete class
     */
    protected static function getFacadeAccessor()
    {
        throw new \Exception('Facade does not implement getAliasAccessor method.');
    }

    public static function __callStatic($method, $args)
    {      
        // Resolve instance from container
        $instance = static::$container->make(static::getFacadeAccessor());
      
        $name = get_class($instance);

        if ( !method_exists($instance, $method)) {
            throw new \Exception($name . ' does not implement ' . $method . ' method.');
        }

        return call_user_func_array(array($instance, $method), $args);
    }

}