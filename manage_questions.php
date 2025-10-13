<?php
include "welcome.php";
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

// ✅ Get search keyword
$q = $_GET['q'] ?? '';

// Fetch available technologies for dropdown
$techResult = mysqli_query($link, "SELECT DISTINCT technology FROM question");
$technologies = [];
while ($row = mysqli_fetch_assoc($techResult)) {
    $technologies[] = $row['technology'];
}

// ✅ Build query dynamically
$sql = "SELECT * FROM question WHERE 1=1";
$params = [];
$types = "";

// Filter by technology
if (!empty($tech)) {
    $sql .= " AND technology = ?";
    $params[] = $tech;
    $types .= "s";
}

// Filter by search keyword
if (!empty($q)) {
    $sql .= " AND qns LIKE ?";
    $params[] = "%" . $q . "%";
    $types .= "s";
}

$sql .= " ORDER BY qid";

// Execute prepared statement
$stmt = $link->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$resultset = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Manage Questions</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');

        body {
            background: #fff;
            margin: 0;
            padding: 0;
            font-family: "Inter Tight", sans-serif;
        }

        .main {
            background: #fff;
            /* width: 100%; */
            /* padding: 20px; */
            /* margin-top: 70px; */
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
            /* margin-right: 8px; */
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
            padding: 5px;
            /* margin-bottom: 10px; */
        }
    </style>
</head>

<body class="bg-gray-200">
    <div class="main xl:overflow-y-hidden h-[88vh] w-[100vw] p-4 mt-[50px]">
        <!-- Technology Filter -->
        <div class="flex justify-between items-center gap-2 fixed bg-white w-[97%] min-h-[50px] top-[50px]">
            <form  method="get" action="">
                <div>
                    <label class="hidden md:inline text-xl text-justify font-medium">Select Technology:</label>
                    <select class="border-1 border-gray-300 rounded-md px-2" name="tech" onchange="this.form.submit()">
                        <option value="">-- All --</option>
                        <?php foreach ($technologies as $t): ?>
                            <option value="<?= htmlspecialchars($t) ?>" <?= ($t == $tech) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($t) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
        </form>

            <!-- Search form (method GET) -->
            <div class="w-[300px] md:w-[500px]">
                <form method="get" action="">
                    <input type="text" name="q" id="q" placeholder="Search using Question"
                        class="border-1 border-gray-300 rounded-sm py-1 px-3 w-[90%] focus:outline-1"
                        value="<?= htmlspecialchars($q, ENT_QUOTES) ?>" />
                    <?php if ($q !== ''): ?>
                        <a href="manage_questions.php" class="cursor-pointer text-red-500 font-bold p-2 ">x</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="px-2 md:px-0">
                <a href="insert.php" class="px-3 py-2 bg-[#191c5c] hidden xl:block text-white font-semibold rounded-md cursor-pointer">Add New Question</a>
                <a href="insert.php" class="px-3 py-2 bg-[#191c5c] xl:hidden text-white font-semibold rounded-md cursor-pointer">Add</a>
            </div>
        </div>

        <table class="table-header sticky top-[35px] mt-[100px] overflow-y-scroll">
            <tr>
                <th class="w-[5%]">ID</th>
                <th class="w-[40%] min-w-[250px]">Question</th>
                <th class="w-[20%] min-w-[200px]">Options</th>
                <th class="w-[8%] min-w-[80px]">Answer</th>
                <th class="w-[10%] min-w-[100px]">Technology</th>
                <th class="w-[10%] min-w-[100px]">Actions</th>
            </tr>
        </table>
        <table class="table-content overflow-y-scroll">
            <?php while ($row = mysqli_fetch_assoc($resultset)): ?>
                <tr>
                    <td class="w-[5%]"><?= $row['qid'] ?></td>
                    <td class="w-[40%] min-w-[250px]"><?= htmlspecialchars($row['qns']) ?></td>
                    <td class="w-[20%]">
                        A: <?= htmlspecialchars($row['OptA']) ?><br>
                        B: <?= htmlspecialchars($row['OptB']) ?><br>
                        C: <?= htmlspecialchars($row['OptC']) ?><br>
                        D: <?= htmlspecialchars($row['OptD']) ?>
                    </td>
                    <td class="w-[8%] min-w-[80px]"><b><?= htmlspecialchars($row['ans']) ?></b></td>
                    <td class="w-[10%]"><?= htmlspecialchars($row['technology']) ?></td>
                    <td class="actions w-[10%]  min-w-[100px]">
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