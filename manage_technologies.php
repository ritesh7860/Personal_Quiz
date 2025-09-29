<?php
session_start();
include 'welcome.php';

// ✅ Only admin can access
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

$msg = "";

// Database connection
$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Handle Add Technology
if (isset($_POST['add'])) {
    $tech_name = trim($_POST['tech_name']);
    $desc = trim($_POST['description']);

    if ($tech_name !== "") {
        $stmt = $link->prepare("INSERT INTO technologies (tech_name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $tech_name, $desc);
        if ($stmt->execute()) {
            $msg = "";
        } else {
            $msg = "⚠ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = "⚠ Technology name is required.";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $link->query("DELETE FROM technologies WHERE id = $id");
}

// Handle Edit Update
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $tech_name = trim($_POST['tech_name']);
    $desc = trim($_POST['description']);

    if ($tech_name !== "") {
        $stmt = $link->prepare("UPDATE technologies SET tech_name=?, description=? WHERE id=?");
        $stmt->bind_param("ssi", $tech_name, $desc, $id);
        if ($stmt->execute()) {
            $msg = "";
        } else {
            $msg = "⚠ Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = "⚠ Technology name is required.";
    }
}

// ✅ Handle Search
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

<body class="w-[100vw]">
    <div class="main bg-white h-auto w-[98vw] flex flex-col xl:flex-row mt-[50px] gap-3 p-4">
        <div class="class w-[100%] xl:w-[75%] left border-1 border-red-400 h-auto shadow-lg">
            <!-- List of Technologies -->
            <div class="flex justify-between items-center p-4 sticky top-[50px] bg-white">
                <div>
                   <h2 class="text-xl font-semibold text-center">Available Technologies</h2>
                </div>
                <!-- 🔍 Search Box -->
                <div>
                    <form method="get" class="flex gap-1 items-center">
                        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search Technology"
                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-1 focus:outline-[#191c5c]">
                        <?php if ($q !== ''): ?>
                            <a href="manage_technologies.php" class="cursor-pointer text-red-500 font-bold p-2 ">x</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <table class="w-full border-collapse border border-gray-300 text-sm">
                <tr class="bg-gray-200 text-left sticky top-[120px]">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Technology</th>
                    <th class="border text-center p-2">Description</th>
                    <th class="border p-2">Created At</th>
                    <th class="border p-2 text-center w-[120px]">Actions</th>
                </tr>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="border p-2"><?= $row['id'] ?></td>
                            <td class="border p-2 font-medium"><?= htmlspecialchars($row['tech_name']) ?></td>
                            <td class="border p-2"><?= htmlspecialchars($row['description']) ?></td>
                            <td class="border p-2"><?= $row['created_at'] ?></td>
                            <td class="border p-2 text-center">
                                <!-- Edit Button -->
                                <button
                                    onclick="document.getElementById('edit-<?= $row['id'] ?>').classList.remove('hidden')" class="mr-3">✏️</button>
                                <!-- Delete Button -->
                                <a href="?delete=<?= $row['id'] ?>"
                                    onclick="return confirm('Are you sure you want to delete this technology?')">🗑</a>
                            </td>
                        </tr>

                        <!-- Hidden Edit Form -->
                        <tr id="edit-<?= $row['id'] ?>" class="hidden bg-gray-50">
                            <td colspan="5" class="p-4">
                                <form method="post" class="space-y-2">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Technology Name</label>
                                        <input type="text" name="tech_name" value="<?= htmlspecialchars($row['tech_name']) ?>"
                                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea name="description" rows="2" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500"><?= htmlspecialchars($row['description']) ?></textarea>
                                    </div>
                                    <button type="submit" name="update" class="px-3 py-1 bg-white border-2 border-[#191c5c] text-[#191c5c] font-semibold rounded hover:bg-gray-200"> Update</button>
                                    <button type="button" onclick="document.getElementById('edit-<?= $row['id'] ?>').classList.add('hidden')" class="px-3 py-1 border-2 border-[#191c5c] bg-[#191c5c] text-white rounded hover:bg-[#191c7c]">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center p-4 text-gray-500">No technologies found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <!-- Right div -->
        <div class="right w-[100%] xl:w-[25%] p-4 bg-white h-[50%] rounded-lg shadow-2xl sticky top-20">
            <div class="flex justify-center">
                <h1 class="text-2xl font-bold py-3">Add Technology</h1>
            </div>

            <!-- Add Form -->
            <form method="post" class="space-y-4 p-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Technology Name</label>
                    <input type="text" name="tech_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-1 focus:outline-[#191c5c]" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-1 focus:outline-[#191c5c]"></textarea>
                </div>
                <button type="submit" name="add" class="w-full py-2 bg-[#191c5c] text-white font-medium rounded-md hover:bg-[#191c7c]"><span class="text-xl text-center">+</span> Add Technology</button>
            </form>

            <!-- Message -->
            <?php if ($msg): ?>
                <p class="mt-4 text-center font-medium text-green-600"><?= htmlspecialchars($msg) ?></p>
            <?php endif; ?>

        </div>
        
    </div>
</body>

</html>