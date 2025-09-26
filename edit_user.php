<?php
session_start();
// if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
//     header("Location: login.php");
//     exit();
// }

$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$email = $_GET['email'] ?? '';
if (!$email) {
    die("Invalid request.");
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    if ($name && $role) {
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $link->prepare("UPDATE regis SET name=?, password=?, role=? WHERE email=?");
            $stmt->bind_param("ssss", $name, $hash, $role, $email);
        } else {
            $stmt = $link->prepare("UPDATE regis SET name=?, role=? WHERE email=?");
            $stmt->bind_param("sss", $name, $role, $email);
        }

        if ($stmt->execute()) {
            header("Location: admin_user.php");
            exit();
        } else {
            $msg = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = "Name and role are required.";
    }
}

// fetch existing data
$stmt = $link->prepare("SELECT name, email, role FROM regis WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$link->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <?php if ($user): ?>
        <form method="post">
            <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required></label><br>
            <label>Email: <input type="text" value="<?= htmlspecialchars($user['email']) ?>" disabled></label><br>
            <label>Role:
                <select name="role">
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </label><br>
            <label>New Password (leave blank to keep current): 
                <input type="password" name="password">
            </label><br>
            <button type="submit">Save Changes</button>
        </form>
    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>
    <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
</body>
</html>
