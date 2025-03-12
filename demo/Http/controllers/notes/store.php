<?php

/**
 * Controller for storing a new note
 * 
 * This controller:
 * - Validates the note body input
 * - Returns to create form if validation fails
 * - Stores the new note in database if validation passes
 * - Redirects to notes index on success
 * 
 * TODO: Replace hardcoded user_id with authenticated user
 */

use Core\App;
use Core\Database;
use Core\Validator;

// Get database instance
$db = App::resolve(Database::class);

// Initialize validation errors array
$errors = [];

// Validate note body (1-1000 characters)
if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

// Return to create form if validation fails
if (! empty($errors)) {
    return view('notes/create.view.php', [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

// Store the new note
$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1 // TODO: Replace with authenticated user ID
]);

// Redirect to notes index
header('location: /notes');
die();
