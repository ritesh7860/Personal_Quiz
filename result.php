<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit;
}

$link = new mysqli("localhost", "root", "", "quiz");
if ($link->connect_error) {
    die("Database connection failed: " . $link->connect_error);
}

$email = $_SESSION['email'];
$name  = $_SESSION['name'] ?? '';
$role  = $_SESSION['role'] ?? 'user';

// ✅ Insert quiz result if it exists in session and not yet saved
if (isset($_SESSION['questions'], $_SESSION['tech'], $_SESSION['correct'])) {
    $tech  = $_SESSION['tech'];
    $score = $_SESSION['correct'];
    $total = count($_SESSION['questions']);

    // Optional: prevent duplicate insert if user refreshes
    $check = $link->prepare("SELECT id FROM results WHERE email=? AND tech_name=? AND created_at >= NOW() - INTERVAL 5 MINUTE");
    $check->bind_param("ss", $email, $tech);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        $stmt = $link->prepare("INSERT INTO results (email, name, tech_name, score, total) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssii", $email, $name, $tech, $score, $total);
        $stmt->execute();
        $stmt->close();
    }
    $check->close();

    // Clear quiz session
    unset($_SESSION['questions'], $_SESSION['current'], $_SESSION['correct'], $_SESSION['tech']);
}

// ✅ For admin: filter by technology
$filterTech = $_GET['tech'] ?? '';

// Get list of available technologies
$techList = $link->query("SELECT DISTINCT tech_name FROM results ORDER BY tech_name ASC");

// Fetch results based on role
if ($role === 'admin') {
    $query = "SELECT r.id, r.email, r.name, r.tech_name, r.score, r.total, r.created_at FROM results r";
    if ($filterTech !== '') {
        $query .= " WHERE r.tech_name = '" . $link->real_escape_string($filterTech) . "'";
    }
    $query .= " ORDER BY r.created_at DESC";
    $results = $link->query($query);

    // Data for chart: avg score per tech
    $chartRes = $link->query("SELECT tech_name, AVG(score) AS avg_score, AVG(total) AS avg_total FROM results GROUP BY tech_name");
    $chartData = [];
    while ($row = $chartRes->fetch_assoc()) {
        $chartData[] = $row;
    }
} else {
    $results = $link->prepare("SELECT id, tech_name, score, total, created_at FROM results WHERE email = ? ORDER BY created_at DESC");
    $results->bind_param("s", $email);
    $results->execute();
    $results = $results->get_result();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz Results</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            /* background: #f4f6f9; */
            color: #333;
        }

        .logo {
            font-family: "Pacifico", cursive;
            /* font-family: "Allison", cursive; */
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #191c5c;
            color: white;
            padding: 15px 20px;
            text-align: center;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .layout {
            display: flex;
            /* margin-top: 50px; */
            height: calc(100vh - 100px);
        }

        .table-section {
            width: auto;
            flex: 2;
            background: white;
            margin: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            /* padding: 20px; */
            overflow-y: auto;
        }

        /* .filter-bar {
            width: 60%;
            position: fixed;
            top: 50px;
            margin-bottom: 15px;
            z-index: 8;
        } */

        select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            /* margin-top: 50px; */
        }

        th,
        td {
            border: none;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #191c5c;
            color: white;
            position: sticky;
            top: 0;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .btn {
            background: #007BFF;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            margin: 5px;
            display: inline-block;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="h-[50px] min-h-[50px] bg-[#191c5c] text-white px-6 py-4 flex justify-between items-center shadow-lg">
        <h1 class=" logo text-2xl font- tracking-wider italic text-white ">Quiz Time</h1>
        <div class="flex items-center gap-4">
            <span class="text-gray-100 hidden md:flex font-semibold">Welcome, <?= htmlspecialchars($name) ?> 👋</span>
            <a href="Logout.php" class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-sm font-semibold">Logout</a>
        </div>
    </nav>

    <div class="layout flex flex-col py-6">
        <div class="flex justify-center">
            <h1 class="mt-[50px] font-semibold text-2xl tracking-wide">Results</h1>
        </div>
        <div class="table-section pb-6">
            
                <div class="filter-bar flex bg-white w-full justify-between items-center p-4">
                <form method="get" action="" class="flex items-center gap-2">
                    <label for="tech" class="font-semibold">Filter by Technology:</label>
                    <select name="tech" id="tech" onchange="this.form.submit()">
                        <option value="">All</option>
                        <?php while ($t = $techList->fetch_assoc()): ?>
                            <option value="<?= htmlspecialchars($t['tech_name']) ?>" <?= ($filterTech === $t['tech_name']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($t['tech_name']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </form>
            </div>

            <div class="overflow-x-auto h-full">
                <table>
                <tr>
                    <?php if ($role === 'admin'): ?>
                        <th>User</th>
                        <th>Email</th>
                    <?php endif; ?>
                    <th>Technology</th>
                    <th>Score</th>
                    <th>Total</th>
                    <th>Percentage</th>
                    <th>Date</th>
                </tr>
                <?php if ($results && $results->num_rows > 0): ?>
                    <?php while ($row = $results->fetch_assoc()): ?>
                        <tr>
                            <?php if ($role === 'admin'): ?>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                            <?php endif; ?>
                            <td><?= htmlspecialchars($row['tech_name']) ?></td>
                            <td><?= $row['score'] ?></td>
                            <td><?= $row['total'] ?></td>
                            <td><?= round(($row['score'] / $row['total']) * 100, 2) ?>%</td>
                            <td><?= $row['created_at'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= $role === 'admin' ? 7 : 5 ?>">No results found.</td>
                    </tr>
                <?php endif; ?>
            </table>
            </div>
        </div>

         <div class="text-center mt-5">
            <a href="User_Home.php" class="px-4 py-2 text-[#191c5c] bg-white border-2 border-[#191c5c] hover:bg-gray-200 font-semibold rounded-md">Home</a>
            <a href="Logout.php" class="bg-[#191c5c] hover:bg-[#191c7c] border-2 border-[#191c5c] text-white px-4 py-2 font-semibold rounded-md">Logout</a>
        </div>
    </div>
</body>

</html>