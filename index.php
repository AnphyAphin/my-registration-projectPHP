<?php require_once 'includes/header.php'; ?>

<div class="hero">
    <h1>Welcome to Our Website</h1>
    <p>Your gateway to amazing content and resources!</p>
</div>

<div id="register">
    <div class="card">
        <h2><i class="fas fa-user-plus"></i> Registration Form</h2>

        <?php
        $errors = [
            'empty' => 'All fields are required!',
            'password_mismatch' => 'Passwords do not match!',
            'username_taken' => 'Username already exists!',
            'weak_password' => 'Password must be at least 8 characters with uppercase, lowercase, number and special character!',
            'database' => 'Database error occurred!'
        ];

        if (isset($_GET['error'])) {
            echo '<div class="alert error">' . ($errors[$_GET['error']] ?? "An error occurred!") . '</div>';
        } elseif (isset($_GET['success'])) {
            echo '<div class="alert success">Registration successful! Please login.</div>';
        }
        ?>

        <form id="registrationForm" action="register.php" method="POST">
            <div class="form-group">
                <label><i class="fas fa-user"></i> Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-at"></i> Username</label>
                <input type="text" id="username" name="username" required>
                <small id="username-error" class="error-text"></small>
            </div>

            <div class="form-group">
                <label><i class="fas fa-lock"></i> Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <small id="password-error" class="error-text"></small>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Register Now
            </button>

            <div style="text-align:center; margin-top:15px;">
                <p>Already have an account?</p>
                <a href="login.php" class="btn btn-secondary">
                    <i class="fas fa-sign-in-alt"></i> Login Here
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>