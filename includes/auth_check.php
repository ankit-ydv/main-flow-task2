<?php
// Helper function to check if user is authenticated
function requireAuth() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

// Helper function to check if user is already logged in
function redirectIfLoggedIn() {
    session_start();
    if (isset($_SESSION['user_id'])) {
        header('Location: dashboard.php');
        exit();
    }
}
?>