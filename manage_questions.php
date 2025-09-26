<?php
include 'welcome.php';
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: Login.php");
    exit;
}


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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .main {
            background: #fff;
            width: 100%;
            padding: 20px;
            margin-top: 70px;
            overflow-y: scroll;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
         }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #191c5c;
            color: white;
            position: sticky;
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
        .table-header{
            /* position: sticky; */
            /* top: 6vh; */
        }

    </style>
</head>

<body class="bg-gray-700">
    <div class="main xl:overflow-y-hidden h-[88vh] 2xl:h-[90vh]">
        <!-- Technology Filter -->
        <form method="get" action="">
            <div class="flex justify-between items-center fixed bg-white w-[97%] h-[10vh] 2xl:h-[8vh] top-[10vh] 2xl:top-[8vh] pr-3" id="">
                <h1 class="text-2xl font-medium">Manage Questions</h1>
                <div>
                    <label class="text-xl text-justify font-medium">Select Technology:</label>
                    <select class="border-2 border-gray-300 rounded-md px-2" name="tech" onchange="this.form.submit()"> 
                        <option value="">-- All --</option>
                        <?php foreach ($technologies as $t): ?>
                            <option value="<?= htmlspecialchars($t) ?>" <?= ($t == $tech) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($t) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>

        <table class="table-header sticky top-[5vh] 2xl:top-[4vh]">
            <tr>
                <th class="w-[5%]">ID</th>
                <th class="w-[45%]">Question</th>
                <th class="w-[25%]">Options</th>
                <th class="w-[8%]">Answer</th>
                <th class="w-[10%]">Technology</th>
                <th class="w-[10%]">Actions</th>
            </tr>
            </table>
            <table class="table-content mt-[6vh] 2xl:mt-[4vh]">
            <?php while ($row = mysqli_fetch_assoc($resultset)): ?>
                <tr>
                    <td class="w-[5%]"><?= $row['qid'] ?></td>
                    <td class="w-[45%]"><?= htmlspecialchars($row['qns']) ?></td>
                    <td class="w-[25%]">
                        A: <?= htmlspecialchars($row['OptA']) ?><br>
                        B: <?= htmlspecialchars($row['OptB']) ?><br>
                        C: <?= htmlspecialchars($row['OptC']) ?><br>
                        D: <?= htmlspecialchars($row['OptD']) ?>
                    </td>
                    <td class="w-[8%]"><b><?= htmlspecialchars($row['ans']) ?></b></td>
                    <td class="w-[10%]"><?= htmlspecialchars($row['technology']) ?></td>
                    <td class="actions w-[10%]">
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