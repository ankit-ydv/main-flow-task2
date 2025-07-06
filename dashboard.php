<?php
session_start();
require_once 'classes/User.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user information
$user = new User();
$user_info = $user->getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - User Authentication</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="dashboard">
        <div class="dashboard-header">
            <h2 class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="user-info">
            <h3>Your Account Information</h3>
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($user_info['id']); ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user_info['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_info['email']); ?></p>
        </div>

        <div class="user-info">
            <h3>Session Information</h3>
            <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
            <p><strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <p style="color: #28a745; font-weight: bold;">✅ You are successfully logged in!</p>
            <p style="color: #666; margin-top: 1rem;">This is a protected page that requires authentication.</p>
        </div>
    </div>
</body>
</html>