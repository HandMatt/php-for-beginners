<?php

/**
 * Controller for displaying all notes
 * 
 * This controller:
 * - Retrieves all notes for the current user from the database
 * - Renders the notes index view with the fetched data
 * 
 * TODO: Replace hardcoded user_id with authenticated user
 */

use Core\App;
use Core\Database;

// Get database instance
$db = App::resolve(Database::class);

// Fetch all notes for the current user
$notes = $db->query('select * from notes where user_id = 1')->get();

// Render the notes index view
view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
