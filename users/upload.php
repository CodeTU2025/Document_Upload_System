<?php
require_once '../classes/Document.php';
require_once '../includes/session.php';
if ($_SESSION['role'] !== 'user') die("Access denied.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doc = new Document();
    $user_id = $_SESSION['user_id'];
    $category = $_POST['category'];
    $doc->upload($user_id, $_FILES['file'], $category);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Upload</title>
  <style>
    body {
      background: url('../assets/background.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .upload-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      width: 350px;
      text-align: center;
    }
    .upload-box h3 {
      margin-bottom: 20px;
      color: #2c3e50;
    }
    .upload-box select,
    .upload-box input[type="file"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .upload-box button {
      width: 100%;
      padding: 10px;
      background: #2980b9;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    .upload-box button:hover {
      background: #3498db;
    }
  </style>
</head>
<body>
  <div class="upload-box">
    <h3>Upload Document</h3>
    <form method="POST" enctype="multipart/form-data">
      <select name="category" required>
        <option value="" disabled selected>Select Category</option>
        <option value="Transcript">Transcript</option>
        <option value="Diploma">Diploma</option>
        <option value="Wedding Cards">Wedding Cards</option>
        <option value="WAEC Certificate">WAEC Certificate</option>
        <option value="Passport Photo">Passport Photo</option>
        <option value="Others">Others</option>
      </select>
      <input type="file" name="file" required>
      <button type="submit">Upload</button>
    </form>
  </div>
</body>
</html>
