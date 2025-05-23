<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
    } elseif ($_SESSION['role'] === 'user') {
        header("Location: user/dashboard.php");
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Document System</title>
</head>
<body>
    <h1>Welcome to the Document Upload System</h1>
    <p><a href="login.php">Login</a> | <a href="register.php">Register</a></p>
</body>
</html>
