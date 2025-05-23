<?php
require_once 'classes/User.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $role = $user->login($_POST['username'], $_POST['password']);

    if ($role === 'admin') header("Location: admin/dashboard.php");
    elseif ($role === 'user') header("Location: users/dashboard.php");
    else $error = "Login failed. Please check your credentials.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      background: url('assets/background.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .login-box {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      width: 320px;
      text-align: center;
    }
    .login-box h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .login-box button {
      width: 100%;
      padding: 10px;
      background: #2c3e50;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    .login-box button:hover {
      background: #34495e;
    }
    .error {
      color: red;
      margin-top: 10px;
    }
    .login-box .register {
      margin-top: 15px;
      font-size: 14px;
    }
    .login-box .register a {
      color: #3498db;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <div class="register">
      Don't have an account? <a href="register.php">Register here</a>
    </div>
  </div>
</body>
</html>
