<?php

require 'functions.php';
require 'Database.php';
// require 'router.php';


$db = new Database();
$post = $db->query("select * from posts;")->fetchAll(PDO::FETCH_ASSOC);

dd($post);
