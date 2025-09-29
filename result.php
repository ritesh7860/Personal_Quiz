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

// ✅ Clear quiz session
unset($_SESSION['questions'], $_SESSION['current'], $_SESSION['correct'], $_SESSION['tech']);

// ✅ For admin: filter by technology
$filterTech = $_GET['tech'] ?? '';

// Get list of available technologies
$techList = $link->query("SELECT DISTINCT tech_name FROM results ORDER BY tech_name ASC");

// Build query based on role
if ($role === 'admin') {
    $query = "
        SELECT r.id, r.email, u.name, r.tech_name, r.score, r.total, r.created_at 
        FROM results r
        JOIN regis u ON r.email = u.email
    ";
    if ($filterTech !== '') {
        $query .= " WHERE r.tech_name = '" . $link->real_escape_string($filterTech) . "'";
    }
    $query .= " ORDER BY r.created_at DESC";
    $results = $link->query($query);

    // Data for chart: avg score per tech
    $chartRes = $link->query("
        SELECT tech_name, AVG(score) AS avg_score, AVG(total) AS avg_total 
        FROM results 
        GROUP BY tech_name
    ");
    $chartData = [];
    while ($row = $chartRes->fetch_assoc()) {
        $chartData[] = $row;
    }
} else {
    $results = $link->prepare("
        SELECT id, tech_name, score, total, created_at 
        FROM results 
        WHERE email = ? 
        ORDER BY created_at DESC
    ");
    $results->bind_param("s", $email);
    $results->execute();
    $results = $results->get_result();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quiz Results</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        header {
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
            margin-top: 70px;
            /* header height */
            height: calc(100vh - 70px);
        }

        .chart-section {
            flex: 1;
            background: white;
            margin: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-y: auto;
        }

        .table-section {
            width: 70%;
            flex: 2;
            background: white;
            margin: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-y: auto;
        }

        .filter-bar {
            width: 60%;
            position: fixed;
            top: 100px;
            margin-bottom: 15px;
            z-index: 8;
        }

        select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #aaa;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 50px;
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
    <header>
        <?= ($role === 'admin') ? include "welcome.php" : "Your Quiz Results, " . htmlspecialchars($name) ?>
    </header>

    <div class="layout">
        <div class="table-section">
            <?php if ($role === 'admin'): ?>
                <div class="filter-bar">
                    <form method="get" action="">
                        <label for="tech">Filter by Technology:</label>
                        <select name="tech" id="tech" onchange="this.form.submit()">
                            <option value="">All</option>
                            <?php while ($t = $techList->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($t['tech_name']) ?>"
                                    <?= ($filterTech === $t['tech_name']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t['tech_name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </form>
                </div>
            <?php endif; ?>

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

            <div style="text-align:center; margin-top:15px;">
                <?php if ($role === 'user'): ?>
                <a href="language_Selection.php" class="btn">Back to Quiz</a>
                <a href="Logout.php" class="btn">Logout</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Graph -->
        <?php if ($role === 'admin' && !empty($chartData)): ?>
            <div class="chart-section h-[50%]">
                <h3 style="text-align:center; color:#191c5c;">📊 Average Scores by Technology</h3>
                <canvas id="techChart"></canvas>
            </div>
        <?php endif; ?>
    </div>



    <?php if ($role === 'admin' && !empty($chartData)): ?>
        <script>
            const ctx = document.getElementById('techChart').getContext('2d');
            const chartData = {
                labels: <?= json_encode(array_column($chartData, 'tech_name')) ?>,
                datasets: [{
                    label: 'Average % Score',
                    data: <?= json_encode(array_map(function ($r) {
                                return round(($r['avg_score'] / $r['avg_total']) * 100, 2);
                            }, $chartData)) ?>,
                    backgroundColor: ['#4CAF50', '#2196F3', '#FF9800', '#E91E63', '#9C27B0']
                }]
            };
            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>