<?php
include 'welcome.php';
session_start();
// if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
//     header("Location: Login.php");
//     exit();
// }

$link = new mysqli('localhost', 'root', '', 'quiz');
$users = $link->query("SELECT name, email, role FROM regis ORDER BY role, name");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 30px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
        }
        th { background: #f4f4f4; }
        a { text-decoration: none; margin: 0 5px; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Manage Users</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td>
                    <a href="edit_user.php?email=<?= urlencode($row['email']) ?>">✏ Edit</a>
                    <a href="delete_user.php?email=<?= urlencode($row['email']) ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p style="text-align:center;">
        <a href="add_user.php">➕ Add New User</a>
    </p>
</body>
</html>
