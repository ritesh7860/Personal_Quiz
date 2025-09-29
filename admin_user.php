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
        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');
        body{
            font-family: "Inter Tight", sans-serif;
        }
        table {
            border-collapse: collapse;
            /* width: 70%; */
            /* margin: 30px auto; */
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
        }

        th:last-child {
            text-align: center;
        }

        a {
            text-decoration: none;
        }

        .no-results {
            text-align: center;
            color: #555;
            margin-top: 14px;
        }
  
    </style>
</head>

<body>
    <div class="mt-[50px]">
        <div class="flex gap-4 md:flex-row md:w-full items-center justify-between p-4">
            <h1 class="hidden md:block text-center text-2xl font-semibold">Manage Users</h1>

            <!-- Search form (method GET) -->
            <div class="w-[300px] md:w-[500px]">
                <form method="get" action="">
                    <input type="text" name="q" id="q" placeholder="Search using name/email" 
                           class="border-1 border-gray-300 rounded-sm py-1 px-3 w-[90%] focus:outline-1"
                           value="<?= htmlspecialchars($q, ENT_QUOTES) ?>" />
                    <?php if ($q !== ''): ?>
                        <a href="admin_user.php" class="cursor-pointer font-bold p-2 text-red-500"> x </a>
                    <?php endif; ?>
                </form>
            </div>

            <div>
                <a href="add_user.php" class="px-3 py-2 bg-[#191c5c] hidden xl:block text-white font-semibold rounded-md cursor-pointer">Add New User</a>
                <a href="add_user.php" class="px-3 py-2 bg-[#191c5c] xl:hidden text-white font-semibold rounded-md cursor-pointer">Add</a>
            </div>
        </div>
        <div class="w-full bg-gray-300 h-[1.2px]"></div>
        <div class="overflow-x-scroll md:overflow-x-hidden py-8 px-4 flex md:justify-center">
            <table class="w-[70%]">
                <tr class="bg-[#191c5c] text-gray-100">
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
                            <td class="min-w-[150px]"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="min-w-[250px]"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="min-w-[120px]"><?= htmlspecialchars($row['role']) ?></td> <!--✏-->
                            <td class="min-w-[180px] flex gap-3 font-medium text-center justify-center items-center">
                                <a class="text-[#191c5c]" href="edit_user.php?email=<?= urlencode($row['email']) ?>"> ✏️ Edit</a>
                                <a class="text-red-500" href="delete_user.php?email=<?= urlencode($row['email']) ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a>
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
