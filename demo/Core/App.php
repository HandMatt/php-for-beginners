<?php

namespace Core;

/**
 * Core Application Container Class
 * 
 * This class provides a static service container implementation:
 * - Manages application-wide dependencies
 * - Provides dependency injection capabilities
 * - Acts as a service locator
 */
class App
{
    /**
     * The container instance holding all bindings
     * @var Container
     */
    protected static $container;

    /**
     * Sets the container instance
     * 
     * @param Container $container The container instance to use
     */
    public static function setContainer($container)
    {
        static::$container = $container;
    }

    /**
     * Gets the current container instance
     * 
     * @return Container The current container instance
     */
    public static function container()
    {
        return static::$container;
    }

    /**
     * Binds a key to a resolver in the container
     * 
     * @param string $key The key to bind
     * @param mixed $resolver The resolver callback or value
     */
    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }

    /**
     * Resolves a key from the container
     * 
     * @param string $key The key to resolve
     * @return mixed The resolved value
     */
    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}
