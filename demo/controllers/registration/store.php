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

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

// Get form inputs
$email = $_POST['email'];
$password = $_POST['password'];

// Validate email and password
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters';
}

// Return to form if validation fails
if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// Check for existing user account
$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    // User already exists - redirect to home
    header('location: /');
    exit();
} else {
    // Create new user with securely hashed password
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login($user);

    header('location: /');
    exit();
}
