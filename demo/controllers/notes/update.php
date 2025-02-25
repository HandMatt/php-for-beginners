<?php

/**
 * Controller for updating an existing note
 * 
 * This controller:
 * - Retrieves the note from database
 * - Verifies user ownership
 * - Validates the updated note body
 * - Updates the note if validation passes
 * - Redirects to notes index on success
 * 
 * TODO: Replace hardcoded user authentication
 */

use Core\App;
use Core\Database;
use Core\Validator;

// Get database instance
$db = App::resolve(Database::class);

// TODO: Replace with actual authentication
$currentUserId = 1;

// Find the requested note or fail
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

// Verify user owns this note
authorize($note['user_id'] === $currentUserId);

// Initialize validation errors array
$errors = [];

// Validate note body (1-1000 characters)
if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

// Return to edit form if validation fails
if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

// Update the note
$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

// Redirect to notes index
header('location: /notes');
die();
