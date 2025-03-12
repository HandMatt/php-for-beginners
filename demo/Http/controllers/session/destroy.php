<?php

/**
 * Logout Controller
 * 
 * Handles user logout by destroying the current session.
 * Route access is restricted to authenticated users only via middleware.
 */

use Core\Authenticator;

(new Authenticator)->logout();

redirect('/');
