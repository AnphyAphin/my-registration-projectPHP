<?php
require_once 'includes/auth_check.php';
require_once 'includes/header.php';
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM users WHERE id = :id LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?> 🎉</h1>

    <div class="profile-card">
        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        <p class="text-muted">@<?php echo htmlspecialchars($user['username']); ?></p>

        <hr style="margin:15px 0;">

        <p><b>Member Since:</b> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>