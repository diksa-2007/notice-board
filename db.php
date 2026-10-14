<?php
require_once __DIR__ . '/vendor/autoload.php';

try {
    $client = new MongoDB\Client("mongodb://127.0.0.1:27017");
    $db = $client->selectDatabase("college_notice_board");

    $notices = $db->notices;
    $users = $db->users;

    // Create useful indexes. MongoDB will ignore an index that already exists.
    $users->createIndex(["email" => 1], ["unique" => true]);
    $notices->createIndex(["notice_date" => -1]);
} catch (Throwable $e) {
    die("MongoDB connection failed: " . htmlspecialchars($e->getMessage()));
}
?>