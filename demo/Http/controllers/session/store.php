<?php

/**
 * Login Authentication Controller
 * 
 * Handles user authentication process:
 * 1. Validates login form submission using LoginForm validator
 * 2. Attempts user authentication with provided credentials
 * 3. Manages authentication failures with appropriate error messages
 * 4. Redirects to home page on successful login
 * 
 * @uses Core\Authenticator
 * @uses Http\Forms\LoginForm
 */

use Core\Authenticator;
use Http\Forms\LoginForm;

// Validate form input using dedicated form validator
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

// Attempt user authentication with validated credentials
$signedIn = (new Authenticator)->attempt(
    $attributes['email'],
    $attributes['password']
);

// If authentication fails, throw validation exception with error message
if (!$signedIn) {
    $form->error(
        'email',
        'No matching account found for that email address and password.'
    )->throw();
}

// Redirect to home page on successful authentication
redirect('/');
