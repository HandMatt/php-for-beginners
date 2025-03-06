<?php

/**
 * Application Routes
 * 
 * Defines all application routes and their corresponding controllers:
 * - Static pages (home, about, contact)
 * - Note CRUD operations (create, read, update, delete)
 * - User registration
 * 
 * Routes are grouped by resource/function and may include middleware
 * restrictions (auth, guest) where appropriate.
 */

// Static Page Routes
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// Notes Resource Routes
$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/destroy.php');

// Note Edit Routes
$router->get('/note/edit', 'controllers/notes/edit.php');
$router->patch('/note', 'controllers/notes/update.php');

// Note Creation Routes
$router->get('/notes/create', 'controllers/notes/create.php');
$router->post('/notes', 'controllers/notes/store.php');

// Registration Routes
$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php');
