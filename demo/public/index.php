<?php

/**
 * Application Entry Point
 * 
 * Bootstrap sequence:
 * 1. Initializes session management
 * 2. Sets up application constants and paths
 * 3. Loads core functionality and autoloader
 * 4. Bootstraps the application
 * 5. Handles routing and request processing
 * 6. Manages validation exceptions and redirects
 * 
 * @uses Core\Session
 * @uses Core\ValidationException
 */

use Core\Session;
use Core\ValidationException;

// Define base path for application
const BASE_PATH = __DIR__ . '/../';

// Register class autoloader
require BASE_PATH . 'vendor/autoload.php';

// Start the session
session_start();

// Load core functions
require BASE_PATH . 'Core/functions.php';

// Initialize application
require base_path('bootstrap.php');

// Create router instance
$router = new \Core\Router();

// Load routes
$routes = require base_path('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    // Route the request to appropriate controller
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    // Store validation errors and old input in session
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    // Redirect back to form
    return redirect($router->previousUrl());
}

// Clean up any flash data after request processing
Session::unflash();
