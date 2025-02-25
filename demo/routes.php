<?php

/**
 * Application Routes
 * 
 * Defines all application routes:
 * - Static pages (home, about, contact)
 * - Note CRUD operations
 * - Routes are grouped by resource/function
 */

// Static Page Routes
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// Notes Resource Routes
$router->get('/notes', 'controllers/notes/index.php');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/destroy.php');

// Note Edit Routes
$router->get('/note/edit', 'controllers/notes/edit.php');
$router->patch('/note', 'controllers/notes/update.php');

// Note Creation Routes
$router->get('/notes/create', 'controllers/notes/create.php');
$router->post('/notes', 'controllers/notes/store.php');

// Registration Routes
$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');
