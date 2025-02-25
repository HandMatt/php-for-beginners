<?php

namespace Core;

use Exception;

/**
 * Dependency Injection Container
 * 
 * Provides a simple dependency injection container that:
 * - Stores service bindings
 * - Resolves dependencies on demand
 * - Throws exceptions for missing bindings
 */
class Container
{
    /**
     * Array of registered bindings
     * @var array
     */
    protected $bindings = [];

    /**
     * Bind a service to the container
     * 
     * @param string $key Service identifier
     * @param callable $resolver Function that returns service instance
     */
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * Resolve a service from the container
     * 
     * @param string $key Service identifier
     * @return mixed Resolved service instance
     * @throws Exception When binding is not found
     */
    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
