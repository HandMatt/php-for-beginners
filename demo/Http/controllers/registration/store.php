<?php

/**
 * Registration Store Controller
 * 
 * This controller:
 * - Validates user registration input (email and password)
 * - Returns to form with errors if validation fails
 * - Checks for existing user with same email
 * - Creates new user account if validation passes
 * - Starts user session and redirects to home
 */

use Core\Authenticator;
use Core\Session;
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

Session::flash('errors', $form->errors());

return redirect('/register');
