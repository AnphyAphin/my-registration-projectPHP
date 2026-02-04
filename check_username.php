<?php
require_once 'config/database.php';
header('Content-Type: application/json');

if (!isset($_GET['username'])) {
    echo json_encode(['available' => false]);
    exit();
}

$username = trim($_GET['username']);

$database = new Database();
$db = $database->getConnection();

$query = "SELECT id FROM users WHERE username = :username LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();

echo json_encode(['available' => $stmt->rowCount() === 0]);
exit();