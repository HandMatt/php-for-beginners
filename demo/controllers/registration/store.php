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

// Validate inputs
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

// Check if user already exists
$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if ($user) {
    // Redirect if user exists
    header('location: /');
    exit();
} else {
    // Create new user
    // TODO: Hash password before storage for security (use password_hash())
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => $password
    ]);

    // Start user session
    $_SESSION['user'] = [
        'email' => $email
    ];

    // Redirect to home
    header('location: /');
    exit();
}
