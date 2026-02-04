<?php
require_once 'includes/auth_check.php';
require_once 'includes/header.php';
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM users WHERWE id = :id LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_SESSION['user_id']);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>

    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-img-placeholder">
                <i class="fas fa-user-circle"></i>
            </div>

            <div class="">
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p class="text-muted">@<?php echo htmlspecialchars($user['username']); ?></p>
            </div>
        </div>

        <div class="profile-info">
            <div class="info-item">
                <span class="label"><i class="fas fa-calendar"> Member Since:</i></span>
                <span><?php echo date('F J, Y', strtotime($user['created_at'])); ?></span>
            </div>
        </div>
    </div>
</div>

<?php 
require_once 'includes/footer.php';
?>