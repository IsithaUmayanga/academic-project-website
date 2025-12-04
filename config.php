<?php
session_start();

// Database configuration
$host = 'localhost';
$dbname = 'job_portal';
$username = 'root';
$password = '';

// Create connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Simple function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Simple function to redirect
function redirect($url) {
    header("Location: $url");
    exit();
}
?>