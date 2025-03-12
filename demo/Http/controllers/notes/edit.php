<?php

/**
 * Controller for displaying the note edit form
 * 
 * This controller:
 * - Retrieves the requested note from the database
 * - Verifies the current user owns the note
 * - Renders the edit form with the note data
 */

use Core\App;
use Core\Database;

// Get database instance
$db = App::resolve(Database::class);

// TODO: Replace with actual authentication
$currentUserId = 1;

// Find the requested note or fail
$note = $db->query('select * from notes where id = :id', [
    'id' => $_GET['id']
])->findOrFail();

// Verify user owns this note
authorize($note['user_id'] === $currentUserId);

// Render edit form with note data
view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);
