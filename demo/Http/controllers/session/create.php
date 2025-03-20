<?php

/**
 * Login Form Controller
 * 
 * Displays the login form view for user authentication.
 * Route access is restricted to guest users only via middleware.
 */

 use Core\Session;

 view('session/create.view.php', [
     'errors' => Session::get('errors')
 ]);