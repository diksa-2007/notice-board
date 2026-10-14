<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view_notice.php");
    exit();
}

try {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $result = $notices->deleteOne(["_id" => $id]);

    header("Location: view_notice.php");
    exit();
} catch (Throwable $e) {
    echo "Error deleting notice.";
}
?>