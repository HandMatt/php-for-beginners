<?php

/**
 * Controller for displaying the note creation form
 * 
 * Renders the create note view with initial empty state:
 * - Sets the page heading
 * - Initializes empty errors array for form validation
 */
view("notes/create.view.php", [
    'heading' => 'Create Note',
    'errors' => []
]);
