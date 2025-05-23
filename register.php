<?php
require_once 'classes/User.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $result = $user->register($_POST['username'], $_POST['password'], 'user');

    if ($result) {
        $success = "Registration successful. You can now <a href='login.php'>login</a>.";
    } else {
        $error = "Registration failed. Username might already exist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <style>
    body {
      background: url('assets/image1.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .register-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      width: 320px;
      text-align: center;
    }
    .register-box h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .register-box input[type="text"],
    .register-box input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .register-box button {
      width: 100%;
      padding: 10px;
      background: #2c3e50;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    .register-box button:hover {
      background: #34495e;
    }
    .error, .success {
      margin-top: 10px;
    }
    .error {
      color: red;
    }
    .success {
      color: green;
    }
    .register-box .login-link {
      margin-top: 15px;
      font-size: 14px;
    }
    .register-box .login-link a {
      color: #3498db;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h2>Register</h2>
    <?php 
      if ($error) echo "<p class='error'>$error</p>";
      if ($success) echo "<p class='success'>$success</p>";
    ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Register</button>
    </form>
    <div class="login-link">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </div>
</body>
</html>
