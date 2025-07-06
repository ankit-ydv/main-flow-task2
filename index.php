<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication System</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="form-title">User Authentication System</h1>
        
        <div style="text-align: center; margin: 2rem 0;">
            <p style="color: #666; margin-bottom: 2rem;">
                Welcome to our secure authentication system built with PHP and MySQL.
            </p>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="alert alert-success">
                    You are logged in as <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </div>
                <a href="dashboard.php" class="btn" style="display: inline-block; text-decoration: none; margin: 0.5rem;">
                    Go to Dashboard
                </a>
                <a href="logout.php" class="logout-btn" style="display: inline-block; text-decoration: none; margin: 0.5rem;">
                    Logout
                </a>
            <?php else: ?>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="login.php" class="btn" style="display: inline-block; text-decoration: none; width: auto; padding: 12px 24px;">
                        Login
                    </a>
                    <a href="signup.php" class="btn" style="display: inline-block; text-decoration: none; width: auto; padding: 12px 24px; background: #28a745;">
                        Sign Up
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 5px; margin-top: 2rem;">
            <h3 style="color: #333; margin-bottom: 1rem;">Features:</h3>
            <ul style="color: #666; line-height: 1.6;">
                <li>✅ Secure user registration and login</li>
                <li>✅ Password hashing with PHP's password_hash()</li>
                <li>✅ SQL injection prevention with prepared statements</li>
                <li>✅ Session management for authenticated users</li>
                <li>✅ Input validation and error handling</li>
                <li>✅ Responsive design with clean UI</li>
            </ul>
        </div>
    </div>
</body>
</html>