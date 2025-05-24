<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_type'] = $user['user_type'];
        header("Location: dashboard.php");
        exit;
    } else {
        die("Invalid email or password.");
    }
}
?>
