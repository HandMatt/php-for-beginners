<?php

$config = include 'config.php';
$db = new Database($config['database']);

$heading = 'Note';
$currentUserId = 1;

$note = $db->query(
    'select * from notes where id = :id',
    [
        'id' => $_GET['id']
    ]
)->findOrFail();

authorise($note['user_id'] === $currentUserId);



require 'views/note.view.php';
