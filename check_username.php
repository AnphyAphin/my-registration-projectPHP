<?php 
require_once 'includes/header.php';
header('Content-Type: application/json');

if (isset($_GET['username'])) {
    echo json_encode(['available' => false]);
    exit();
}

$username = $_POST['username'];

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM users WHERE username = :username LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();

echo json_encode(['available' => $stmt->rowCount() === 0]);
?>