<?php
// admin/dashboard.php
require_once '../classes/Document.php';
require_once '../includes/session.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

$doc = new Document();
$result = $doc->getAllDocuments();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            display: flex;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 220px;
            background-color: #003366;
            color: #fff;
            padding: 20px;
            height: 100vh;
        }
        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
        }
        .sidebar a:hover {
            background-color: #00509e;
            padding-left: 5px;
        }
        .content {
            flex: 1;
            padding: 20px;
            background-color: #f0f0f0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #999;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #ccc;
        }
        a.button {
            padding: 5px 10px;
            background-color: #003366;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        a.button:hover {
            background-color: #00509e;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="upload.php">Upload Document</a>
    <a href="view_users.php">View Users</a>
    <a href="../logout.php">Logout</a>
</div>

<div class="content">
    <h2>All Uploaded Documents</h2>
    <table>
        <tr>
            <th>Filename</th>
            <th>Category</th>
            <th>User</th>
            <th>Uploaded At</th>
            <th>Download</th>
        </tr>
        <?php while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)): ?>
            <?php
                $filename = htmlspecialchars($row['filename']);
                $category = htmlspecialchars($row['category']);
                $username = htmlspecialchars($row['username']);
                $uploadedAt = $row['uploaded_at'] ? $row['uploaded_at']->format('Y-m-d H:i') : 'N/A';
                $downloadPath = "../CodeTu/download/{$category}/{$filename}";
            ?>
            <tr>
                <td><?= $filename ?></td>
                <td><?= $category ?></td>
                <td><?= $username ?></td>
                <td><?= $uploadedAt ?></td>
                <td><a class="button" href="<?= $downloadPath ?>" download>Download</a></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
