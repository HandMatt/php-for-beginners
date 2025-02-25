<?php

/**
 * Application Entry Point
 * 
 * This file:
 * - Defines the base path constant
 * - Loads core functions and autoloader
 * - Initializes the router
 * - Handles incoming HTTP requests
 */

// Define base path for application
const BASE_PATH = __DIR__ . '/../';

// Load core functions
require BASE_PATH . 'Core/functions.php';

// Register class autoloader
spl_autoload_register(function ($class) {
    // Convert namespace separators to directory separators
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});

// Initialize application
require base_path('bootstrap.php');

// Create router instance
$router = new \Core\Router();

// Load routes
$routes = require base_path('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);
