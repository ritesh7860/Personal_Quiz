<?php
session_start();
include 'welcome.php';

if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

$msg = "";

$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Add Technology
if (isset($_POST['add'])) {
    $tech_name = trim($_POST['tech_name']);

    if ($tech_name !== "") {
        $stmt = $link->prepare("INSERT INTO technologies (tech_name) VALUES (?)");
        $stmt->bind_param("s", $tech_name);
        if (!$stmt->execute()) {
            $msg = "⚠ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = "⚠ Technology name is required.";
    }
}

// Delete Technology
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $link->prepare("DELETE FROM technologies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Update Technology
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $tech_name = trim($_POST['tech_name']);

    if ($tech_name !== "") {
        $stmt = $link->prepare("UPDATE technologies SET tech_name=? WHERE id=?");
        $stmt->bind_param("si", $tech_name, $id);
        if (!$stmt->execute()) {
            $msg = "⚠ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = "⚠ Technology name is required.";
    }
}

// Search
$search = $_GET['search'] ?? "";
if ($search !== "") {
    $stmt = $link->prepare("SELECT * FROM technologies WHERE tech_name LIKE ? ORDER BY created_at DESC");
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $link->query("SELECT * FROM technologies ORDER BY id ASC");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Technologies</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-[98vw] bg-gray-50">
    <div class="main flex flex-col xl:flex-row mt-[50px] gap-4 p-4">
        <!-- Left Panel: Technology List -->
        <div class="w-full xl:w-[75%] bg-white border border-gray-200 rounded-md shadow-md px-4 py-2">
            <div class="flex justify-between items-center py-4 sticky top-[50px] bg-white z-4">
                <h2 class="text-2xl hidden md:flex font-semibold ">Available Technologies</h2>
                <!-- Search -->
                <form method="get" class="flex gap-2 items-center">
                    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                        placeholder="Search Technology"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-[#191c5c]">
                    <?php if ($search !== ''): ?>
                        <a href="manage_technologies.php" class="text-red-600 text-lg font-bold">×</a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Table -->
            <table class="w-full border border-gray-200 text-sm">
                <thead class="bg-[#191c5c] text-white sticky top-[120px]">
                    <tr>
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Technology</th>
                        <th class="border p-2">Created At</th>
                        <th class="border p-2 text-center w-[120px]">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2"><?= $row['id'] ?></td>
                                <td class="border p-2 font-medium"><?= htmlspecialchars($row['tech_name']) ?></td>
                                <td class="border p-2"><?= $row['created_at'] ?></td>
                                <td class="border p-2 text-center">
                                    <button onclick="document.getElementById('edit-<?= $row['id'] ?>').classList.remove('hidden')" class="mr-2 text-blue-600 ">✏️</button>
                                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this technology?')" class="text-red-600">🗑</a>
                                </td>
                            </tr>

                            <!-- Edit Form Row -->
                            <tr id="edit-<?= $row['id'] ?>" class="hidden bg-gray-50">
                                <td colspan="4" class="p-4">
                                    <form method="post" class="space-y-2">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div>
                                            <label class="block text-sm text-start font-medium text-gray-700">Technology Name</label>
                                            <input type="text" name="tech_name" value="<?= htmlspecialchars($row['tech_name']) ?>"
                                                class="w-full px-4 py-2 border rounded-md focus:outline-[#191c5c]" required>
                                        </div>
                                        <div class="flex gap-3 justify-end">
                                            <button type="submit" name="update"
                                                class="px-4 py-2 border-2 border-[#191c5c] text-[#191c5c] font-medium rounded hover:bg-gray-100">
                                                Update
                                            </button>
                                            <button type="button"
                                                onclick="document.getElementById('edit-<?= $row['id'] ?>').classList.add('hidden')"
                                                class="px-4 py-2 bg-[#191c5c] text-white rounded hover:bg-[#191c7c]">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center p-4 text-gray-500">No technologies found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Right Panel: Add Technology -->
        <div class="w-full xl:w-[25%] p-4 bg-white rounded-md shadow-lg h-fit sticky top-20">
            <h1 class="text-xl font-semibold text-center text-[#191c5c] mb-4">Add Technology</h1>
            <form method="post" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Technology Name</label>
                    <input type="text" name="tech_name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-[#191c5c]" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="submit" name="add" class="py-1 px-4 bg-[#191c5c] text-white font-medium rounded-md hover:bg-[#191c7c]">
                        Add
                    </button>
                    <button type="reset" name="add" class=" py-1 px-3 bg-white text-[#191c5c] border-2 border-[#191c5c] font-medium rounded-md hover:bg-gray-200">
                        Reset
                    </button>
                </div>
            </form>

            <!-- Message -->
            <?php if ($msg): ?>
                <p class="mt-4 text-center font-medium text-red-600"><?= htmlspecialchars($msg) ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>