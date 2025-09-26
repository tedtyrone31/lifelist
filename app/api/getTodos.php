<?php
require_once __DIR__ . '/../../models/Todo.php';

header('Content-Type: application/json');

// Example: you can pass userId via GET or POST
$userId = isset($_GET['userId']) ? (int)$_GET['userId'] : 0;
$status = isset($_GET['status']) ? $_GET['status'] : 'pending'; // default pending

if ($userId <= 0) {
    echo json_encode(['error' => 'Invalid userId']);
    exit;
}

// Optional: filter by tags (comma-separated)
$tags = isset($_GET['tags']) ? explode(',', $_GET['tags']) : [];

$todos = Todo::getAllTodoByUserAndStatus($userId, $status, $tags);

echo json_encode($todos);
