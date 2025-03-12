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

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

// Get form inputs
$email = $_POST['email'];
$password = $_POST['password'];

// Validate input format
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password.';
}

if (! empty($errors)) {
    return view('session/create.view.php', [
        'errors' => $errors
    ]);
}

// Attempt user authentication
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email
        ]);

        header('location: /');
        exit();
    }
}

// Authentication failed - return to login form
return view('session/create.view.php', [
    'errors' => [
        'email' => 'No matching account for that email address and password.'
    ]
]);
