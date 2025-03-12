<?php

/**
 * Login Authentication Controller
 * 
 * This controller:
 * - Validates login credentials (email and password)
 * - Returns to form with errors if validation fails
 * - Verifies user exists and password matches
 * - Starts user session on successful authentication
 * - Redirects to home page after login
 */

use Core\Authenticator;
use Http\Forms\LoginForm;

// Get form inputs
$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

// Validate input format
if ($form->validate($email, $password)) {
    if ((new Authenticator)->attempt($email, $password)) {
        redirect('/');
    }

    $form->error('email', 'No matching account found for that email address and password.');
}

// Authentication failed - return to login form
return view('session/create.view.php', [
    'errors' => $form->errors()
]);
