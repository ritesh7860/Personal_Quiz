<?php
session_start();

// Protect page (optional)
// if (!isset($_SESSION['email'])) {
//     header("Location: Login.php");
//     exit;
// }

$link = mysqli_connect("localhost", "root", "", "quiz");
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle Delete
if (isset($_GET['delete'])) {
    $qid = intval($_GET['delete']);
    $stmt = $link->prepare("DELETE FROM question WHERE qid=?");
    $stmt->bind_param("i", $qid);
    $stmt->execute();
    $stmt->close();
    header("Location: manage_questions.php?tech=" . urlencode($_GET['tech']));
    exit;
}

// Get selected technology
$tech = $_GET['tech'] ?? '';

// Fetch available technologies for dropdown
$techResult = mysqli_query($link, "SELECT DISTINCT technology FROM question");
$technologies = [];
while ($row = mysqli_fetch_assoc($techResult)) {
    $technologies[] = $row['technology'];
}

// Fetch questions (filtered by technology if chosen)
if ($tech) {
    $stmt = $link->prepare("SELECT * FROM question WHERE technology=? ORDER BY qid");
    $stmt->bind_param("s", $tech);
    $stmt->execute();
    $resultset = $stmt->get_result();
} else {
    $resultset = mysqli_query($link, "SELECT * FROM question ORDER BY qid");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Questions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .actions a {
            margin-right: 8px;
            text-decoration: none;
            font-size: 16px;
        }
        .edit {
            color: #28a745;
        }
        .delete {
            color: #dc3545;
        }
        select {
            padding: 6px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage Questions</h2>

    <!-- Technology Filter -->
    <form method="get" action="">
        <label>Select Technology:</label>
        <select name="tech" onchange="this.form.submit()">
            <option value="">-- All --</option>
            <?php foreach ($technologies as $t): ?>
                <option value="<?= htmlspecialchars($t) ?>" <?= ($t==$tech)?'selected':'' ?>>
                    <?= htmlspecialchars($t) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Options</th>
            <th>Answer</th>
            <th>Technology</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultset)): ?>
        <tr>
            <td><?= $row['qid'] ?></td>
            <td><?= htmlspecialchars($row['qns']) ?></td>
            <td>
                A: <?= htmlspecialchars($row['OptA']) ?><br>
                B: <?= htmlspecialchars($row['OptB']) ?><br>
                C: <?= htmlspecialchars($row['OptC']) ?><br>
                D: <?= htmlspecialchars($row['OptD']) ?>
            </td>
            <td><b><?= htmlspecialchars($row['ans']) ?></b></td>
            <td><?= htmlspecialchars($row['technology']) ?></td>
            <td class="actions">
                <a class="edit" href="edit_question.php?qid=<?= $row['qid'] ?>">✏️</a>
                <a class="delete" href="?delete=<?= $row['qid'] ?>&tech=<?= urlencode($tech) ?>"
                   onclick="return confirm('Are you sure you want to delete this question?');">🗑️</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
