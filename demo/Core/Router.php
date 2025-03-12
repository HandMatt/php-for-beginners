<?php

namespace Core;

use Core\Middleware\Middleware;

/**
 * HTTP Router
 * 
 * Handles routing functionality:
 * - Registers routes for different HTTP methods
 * - Matches incoming requests to registered routes
 * - Loads appropriate controllers
 */
class Router
{
    /**
     * Registered routes
     * @var array
     */
    protected $routes = [];

    /**
     * Add a route to the router
     * 
     * @param string $method HTTP method
     * @param string $uri URI to match
     * @param string $controller Controller path
     */
    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];

        return $this;
    }

    /**
     * Register GET route
     * 
     * @param string $uri The URI to match
     * @param string $controller The controller path
     * @return $this
     */
    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }

    /**
     * Register POST route
     * 
     * @param string $uri The URI to match
     * @param string $controller The controller path
     * @return $this
     */
    public function post($uri, $controller)
    {
        return $this->add('POST', $uri, $controller);
    }

    /**
     * Register DELETE route
     * 
     * @param string $uri The URI to match
     * @param string $controller The controller path
     * @return $this
     */
    public function delete($uri, $controller)
    {
        return $this->add('DELETE', $uri, $controller);
    }

    /**
     * Register PATCH route
     * 
     * @param string $uri The URI to match
     * @param string $controller The controller path
     * @return $this
     */
    public function patch($uri, $controller)
    {
        return $this->add('PATCH', $uri, $controller);
    }

    /**
     * Register PUT route
     * 
     * @param string $uri The URI to match
     * @param string $controller The controller path
     * @return $this
     */
    public function put($uri, $controller)
    {
        return $this->add('PUT', $uri, $controller);
    }

    /**
     * Apply middleware to the last registered route
     * 
     * @param string $key The middleware key to apply
     * @return $this
     */
    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /**
     * Route the request to appropriate controller
     * 
     * @param string $uri Request URI
     * @param string $method HTTP method
     * @return mixed Controller response
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        $this->abort();
    }

    /**
     * Abort the request with an error page
     * 
     * @param int $code HTTP status code
     */
    protected function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}
