<?php

/**
 * Controller for displaying a single note
 * 
 * This controller:
 * - Retrieves a specific note by ID from the database
 * - Verifies the current user owns the note
 * - Renders the note detail view
 * 
 * TODO: Replace hardcoded user authentication
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

// Render the note detail view
view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
