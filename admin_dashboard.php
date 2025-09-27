<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

// Only allow logged-in admins
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: Login.php");
    exit();
}

$adminName = isset($_SESSION['name']) ? $_SESSION['name'] : 'Admin';
// Database connection
$link = new mysqli("localhost", "root", "", "quiz");

// Stats
$totalUsers = $link->query("SELECT COUNT(*) as c FROM regis")->fetch_assoc()['c'];
$totalAdmins = $link->query("SELECT COUNT(*) as c FROM regis WHERE role='admin'")->fetch_assoc()['c'];
$totalQuestions = $link->query("SELECT COUNT(*) as c FROM question")->fetch_assoc()['c'];
$totalTechs = $link->query("SELECT COUNT(DISTINCT technology) as c FROM question")->fetch_assoc()['c'];

// Recent users (last 5)
$recentUsers = $link->query("SELECT name, email, role FROM regis ORDER BY role DESC LIMIT 5");

// Recent questions (last 5)
$recentQuestions = $link->query("SELECT qns, technology FROM question ORDER BY qid DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <header class="bg-[#191c5c] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
            <div class="flex items-center gap-4">
                <span>Welcome, <?= htmlspecialchars($adminName) ?> 👋</span>
                <a href="Logout.php" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-sm font-semibold">Logout</a>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        <!-- Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-700">Total Users</h2>
                <p class="mt-3 text-3xl font-bold text-[#191c5c]"><?= $totalUsers ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-700">Admins</h2>
                <p class="mt-3 text-3xl font-bold text-[#191c5c]"><?= $totalAdmins ?></p>
                <div class="w-full bg-gray-200 rounded-full h-2 mt-3">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: <?= ($totalUsers > 0) ? round(($totalAdmins / $totalUsers) * 100) : 0 ?>%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1"><?= ($totalUsers > 0) ? round(($totalAdmins / $totalUsers) * 100) : 0 ?>% are admins</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-700">Questions</h2>
                <p class="mt-3 text-3xl font-bold text-[#191c5c]"><?= $totalQuestions ?></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <h2 class="text-lg font-semibold text-gray-700">Technologies</h2>
                <p class="mt-3 text-3xl font-bold text-[#191c5c]"><?= $totalTechs ?></p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <a href="admin_user.php" class="bg-white rounded-xl p-6 shadow hover:bg-blue-50 transition">
                <h3 class="text-lg font-bold text-[#191c5c]">👥 Manage Users</h3>
                <p class="text-gray-600 mt-2">Add, edit or delete users.</p>
            </a>
            <a href="manage_questions.php" class="bg-white rounded-xl p-6 shadow hover:bg-blue-50 transition">
                <h3 class="text-lg font-bold text-[#191c5c]">📘 Manage Questions</h3>
                <p class="text-gray-600 mt-2">View, edit and add quiz questions.</p>
            </a>
            <a href="reports.php" class="bg-white rounded-xl p-6 shadow hover:bg-blue-50 transition">
                <h3 class="text-lg font-bold text-[#191c5c]">📊 Reports</h3>
                <p class="text-gray-600 mt-2">View quiz performance reports.</p>
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Users -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-bold text-[#191c5c] mb-4">👥 Recent Users</h3>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="pb-2">Name</th>
                            <th class="pb-2">Email</th>
                            <th class="pb-2">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($u = $recentUsers->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2"><?= htmlspecialchars($u['name']) ?></td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td><?= htmlspecialchars($u['role']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Recent Questions -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-bold text-[#191c5c] mb-4">📝 Recent Questions</h3>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="pb-2">Question</th>
                            <th class="pb-2">Technology</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($q = $recentQuestions->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2"><?= htmlspecialchars(substr($q['qns'], 0, 40)) ?>...</td>
                                <td><?= htmlspecialchars($q['technology']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>