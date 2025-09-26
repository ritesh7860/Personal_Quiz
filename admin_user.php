<?php
include 'welcome.php';
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: Login.php");
    exit();
}

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

        th,
        td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f4f4f4;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="mt-[10vh] 2xl:mt-[8vh] p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-center text-2xl font-semibold pt-2">Manage Users</h1>
            <div>
                <input type="search" name="" id="" placeholder="Search using Name/Email" class="border-1 border-gray-400 rounded-full py-1 px-2 ">
            </div>
            <div>
                <a href="add_user.php" class="px-3 py-2 bg-[#191c5c] text-white font-semibold rounded-md cursor-pointer">Add New User</a>
            </div>
        </div>
        <div>
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
        </div>
    </div>

</body>

</html>