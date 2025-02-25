<?php

namespace Core;

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
        ];
    }

    /**
     * Register GET route
     */
    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    /**
     * Register POST route
     */
    public function post($uri, $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    /**
     * Register DELETE route
     */
    public function delete($uri, $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    /**
     * Register PATCH route
     */
    public function patch($uri, $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    /**
     * Register PUT route
     */
    public function put($uri, $controller)
    {
        $this->add('PUT', $uri, $controller);
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
                return require base_path($route['controller']);
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
