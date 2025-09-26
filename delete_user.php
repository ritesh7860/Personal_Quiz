<?php
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['email'])) {
    die("Invalid request.");
}

$email = $_GET['email'];

$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$stmt = $link->prepare("DELETE FROM regis WHERE email=?");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    header("Location: admin_user.php");
    exit();
} else {
    echo "Error deleting user: " . $stmt->error;
}

$stmt->close();
$link->close();
