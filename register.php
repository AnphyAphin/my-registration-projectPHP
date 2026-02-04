<?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit();
}

$username = trim($_POST['username']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$name = trim($_POST['name']);

if (empty($username) || empty($password) || empty($name)) {
    header("Location: index.php?error=empty");
    exit();
}

if ($password !== $confirm_password) {
    header("Location: index.php?error=password_mismatch");
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


$query = "INSERT INTO users (username, password, name)
          VALUES (:username, :password, :name)";

$stmt = $db->prepare($query);
$stmt->bindParam(":username", $username);
$stmt->bindParam(":password", $hashed_password);
$stmt->bindParam(":name", $name);

if ($stmt->execute()) {
    header("Location: index.php?success=true");
} else {
    header("Location: index.php?error=database");
}
exit();
?>