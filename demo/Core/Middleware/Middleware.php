<?php

namespace Core\Middleware;

/**
 * Base Middleware Handler
 * 
 * Manages middleware resolution and execution in the application
 */
class Middleware
{
    /**
     * Map of middleware keys to their respective handler classes
     * 
     * @var array
     */
    const MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class,
    ];

    /**
     * Resolve and execute the appropriate middleware
     * 
     * @param string|null $key The middleware key to resolve
     * @throws \Exception When no matching middleware is found
     * @return void
     */
    public static function resolve($key)
    {
        if (! $key) {
            return;
        }

        $Middleware = static::MAP[$key] ?? false;

        if (! $Middleware) {
            throw new \Exception("No matching middleware found for key '{$key}'.");
        }

        (new $Middleware)->handle();
    }
}
