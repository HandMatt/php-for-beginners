<?php

/**
 * Application Bootstrap File
 * 
 * Initializes core application components:
 * - Sets up the dependency container
 * - Configures database connection
 * - Binds core services
 */

use Core\App;
use Core\Container;
use Core\Database;

// Create new dependency container
$container = new Container();

// Bind database connection to container
$container->bind('Core\Database', function () {
    $config = require base_path('config.php');

    return new Database($config['database']);
});

// Set container as application service container
App::setContainer($container);
