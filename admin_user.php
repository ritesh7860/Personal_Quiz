<?php
// ensure session is started first
session_start();

// include your welcome/header if needed (keeps existing UI)
include 'welcome.php';

// admin-only
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: Login.php");
    exit();
}

// DB connection
$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("DB connection failed: " . $link->connect_error);
}

// read query (search term) from GET
$q = trim((string)($_GET['q'] ?? ''));

// prepare result set depending on whether a search query exists
if ($q !== '') {
    // search by name or email (partial, case-insensitive)
    $like = "%{$q}%";
    $stmt = $link->prepare("SELECT name, email, role FROM regis WHERE name LIKE ? OR email LIKE ? ORDER BY role, name");
    if ($stmt === false) {
        die("Prepare failed: " . $link->error);
    }
    $stmt->bind_param('ss', $like, $like);
    $stmt->execute();
    $users = $stmt->get_result();
} else {
    $users = $link->query("SELECT name, email, role FROM regis ORDER BY role, name");
    if ($users === false) {
        die("Query failed: " . $link->error);
    }
}
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

        .no-results {
            text-align: center;
            color: #555;
            margin-top: 14px;
        }

        .search-box {
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="mt-[10vh] 2xl:mt-[8vh] p-4">
        <div class="flex items-center justify-between">
            <h1 class="text-center text-2xl font-semibold pt-2">Manage Users</h1>

            <!-- Search form (method GET) -->
            <div class="search-box">
                <form method="get" action="">
                    <input type="search" name="q" id="q" placeholder="Search using Name/Email" 
                           class="border-1 border-gray-400 rounded-full py-1 px-2"
                           value="<?= htmlspecialchars($q, ENT_QUOTES) ?>" />
                    <button type="submit">Search</button>
                    <?php if ($q !== ''): ?>
                        <a href="admin_user.php" style="margin-left:8px;">Reset</a>
                    <?php endif; ?>
                </form>
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

                <?php if ($users->num_rows === 0): ?>
                    <tr>
                        <td colspan="4" class="no-results">No users found for "<?= htmlspecialchars($q, ENT_QUOTES) ?>"</td>
                    </tr>
                <?php else: ?>
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
                <?php endif; ?>
            </table>
        </div>
    </div>

</body>

</html>
<?php
// cleanup
if (isset($stmt) && $stmt instanceof mysqli_stmt) {
    $stmt->close();
}
$link->close();
?>
