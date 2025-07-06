<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'user_auth';

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $database");
    echo "✅ Database '$database' created successfully<br>";
    
    // Use the database
    $pdo->exec("USE $database");
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "✅ Users table created successfully<br>";
    
    // Create indexes
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_email ON users(email)");
    $pdo->exec("CREATE INDEX IF NOT EXISTS idx_username ON users(username)");
    echo "✅ Database indexes created successfully<br>";
    
    echo "<br><strong>🎉 Setup completed successfully!</strong><br>";
    echo "<a href='index.php'>Go to Login System</a>";
    
} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>