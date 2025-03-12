<?php

/**
 * Application Routes
 * 
 * Defines all application routes and their corresponding controllers:
 * - Static pages (home, about, contact)
 * - Note CRUD operations (create, read, update, delete)
 * - User registration
 * - User authentication (login, logout)
 * 
 * Routes are grouped by resource/function and may include middleware
 * restrictions (auth, guest) where appropriate.
 */

// Static Page Routes
$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// Notes Resource Routes
$router->get('/notes', 'notes/index.php')->only('auth');
$router->get('/note', 'notes/show.php');
$router->delete('/note', 'notes/destroy.php');

// Note Edit Routes
$router->get('/note/edit', 'notes/edit.php');
$router->patch('/note', 'notes/update.php');

// Note Creation Routes
$router->get('/notes/create', 'notes/create.php');
$router->post('/notes', 'notes/store.php');

// Registration Routes
$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

// Login Routes
$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
