<?php
require_once __DIR__ . '/../../models/Tobuy.php';

header('Content-Type: application/json');

// Required params
$userId = isset($_GET['userId']) ? (int)$_GET['userId'] : 0;
$status = isset($_GET['status']) ? $_GET['status'] : 'pending'; // default pending

if ($userId <= 0) {
    echo json_encode(['error' => 'Invalid userId']);
    exit;
}

// Optional: tags (comma-separated in query string)
$tags = isset($_GET['tags']) ? explode(',', $_GET['tags']) : [];

// Fetch data using your model
$tobuys = Tobuy::getAllTobuyByUserAndStatus($userId, $status, $tags);

// Build clean array for JSON response
if (empty($tobuys)) {
    echo json_encode(['message' => 'No records found', 'debug' => ['userId' => $userId, 'status' => $status, 'tags' => $tags]]);
    exit;
}
$response = [];
foreach ($tobuys as $item) {
    $response[] = [
        'tobuyId'          => $item->tobuyId,
        'userId'           => $item->userId,
        'tobuyItem'        => $item->tobuyItem,
        'tag'              => $item->tag,
        'status'           => $item->status,
        'created_at'       => $item->created_at,
        'updated_at'       => $item->updated_at,
        'tobuyDescription' => $item->tobuyDescription,
        'quantity'         => $item->quantity,
        'unit'             => $item->unit,
        'price'            => $item->price,
        'total'            => $item->total
    ];
}

echo json_encode($response);
