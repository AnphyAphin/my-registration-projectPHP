<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$name = trim($_POST['name']);
$username = trim($_POST['username']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (empty($name) || empty($username) || empty($password) || empty($confirm_password)) {
    header("Location: index.php?error=empty");
    exit();
}

if ($password !== $confirm_password) {
    header("Location: index.php?error=password_mismatch");
    exit();
}

if (
    strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password) ||
    !preg_match('/[\W]/', $password)
) {
    header("Location: index.php?error=weak_password");
    exit();
}

$database = new Database();
$db = $database->getConnection();

$query = "SELECT id FROM users WHERE username = :username LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    header("Location: index.php?error=username_taken");
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO users (name, username, password) VALUES (:name, :username, :password)";
$stmt = $db->prepare($query);
$stmt->bindParam(":name", $name);
$stmt->bindParam(":username", $username);
$stmt->bindParam(":password", $hashed_password);

if ($stmt->execute()) {
    header("Location: index.php?success=true");
    exit();
}

header("Location: index.php?error=database");
exit();
