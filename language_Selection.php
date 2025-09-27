<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit;
}

// DB Connection
$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

// Fetch technologies
$result = $link->query("SELECT tech_name FROM technologies ORDER BY tech_name ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        /* Background with gradient */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #191c5c, #2c3e8d);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        /* Card container */
        .container {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            padding: 40px;
            width: 420px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            margin-bottom: 15px;
            color: #191c5c;
        }

        p {
            margin-bottom: 20px;
            color: #333;
        }

        /* Button styles */
        .btn {
            display: block;
            background: linear-gradient(135deg, #4CAF50, #2e8b57);
            color: white;
            padding: 14px 25px;
            margin: 12px auto;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            width: 85%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #45a049, #3cb371);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Logout link */
        .logout {
            margin-top: 20px;
            display: inline-block;
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout:hover {
            color: #c0392b;
            text-decoration: underline;
        }

        /* Animation */
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['name']) ?> 👋</h2>
        <p>Select a technology to start your quiz:</p>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <a href="quiz_1.php?tech=<?= urlencode($row['tech_name']) ?>" class="btn">
                    <?= htmlspecialchars($row['tech_name']) ?>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No technologies available yet.</p>
        <?php endif; ?>

        <a href="Logout.php" class="logout">🚪 Logout</a>
    </div>
</body>
</html>
