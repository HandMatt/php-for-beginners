<?php

/**
 * Controller for handling note deletion
 * 
 * This controller:
 * - Retrieves the note by ID from the database
 * - Verifies the current user owns the note
 * - Deletes the note if authorized
 * - Redirects back to notes index
 */

use Core\App;
use Core\Database;

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

// Delete the note
$db->query('delete from notes where id = :id', [
    'id' => $_POST['id']
]);

// Redirect back to notes index
header('location: /notes');
exit();
