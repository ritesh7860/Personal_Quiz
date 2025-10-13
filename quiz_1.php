<?php
// quiz_1.php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "quiz");
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Load questions only once per session/tech
if (!isset($_SESSION['questions'])) {
    if (!isset($_GET['tech'])) {
        header("Location: welcome.php");
        exit;
    }
    $tech = $_GET['tech'];

    // Save selected technology in session
    $_SESSION['tech'] = $tech;

    // Fetch 20 random questions of selected technology
    $stmt = $link->prepare("SELECT * FROM question WHERE technology=? ORDER BY RAND() LIMIT 10");
    $stmt->bind_param("s", $tech);
    $stmt->execute();
    $resultset = $stmt->get_result();

    $questions = [];
    while ($r = mysqli_fetch_assoc($resultset)) {
        $questions[] = $r;
    }

    if (empty($questions)) {
        die("No questions available for $tech");
    }

    $_SESSION['questions'] = $questions;
    $_SESSION['current'] = 0;
    $_SESSION['correct'] = 0;
}


$questions = $_SESSION['questions'];
$current = $_SESSION['current'];


// Handle answer submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = $_POST['answer'] ?? '';
    $correctAnswer = $questions[$current]['ans'];

    // Store the user's selected answer
    $_SESSION['answers'][$current] = $selected;

    if ($selected === $correctAnswer) {
        $_SESSION['correct']++;
    }

    $_SESSION['current']++;

    if ($_SESSION['current'] >= count($questions)) {
        header("Location: review.php");
        exit;
    } else {
        header("Location: quiz_1.php"); // no tech param needed anymore
        exit;
    }
}

$question = $questions[$current];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');

        body {
            /* font-family: "Pacifico", cursive; */
            margin: 0;
            padding: 0;
        }

        label {
            display: block;
            margin: 10px 0;
            padding: 12px;
            background: #f5f5f5;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
            text-align: start;
        }

        input[type="radio"] {
            margin-right: 10px;
        }
    </style>
</head>

<body class="bg-gray-50 h-[100vh] w-[100vw] bg-gradient-to-l from-[#191c5d] to-[#191c2c] ">
    <div class="flex h-full w-full items-center justify-center">
        <div class="quiz-container w-[90%] md:w-[35%] h-auto bg-white p-6 rounded-xl text-center shadow-lg">
            <h2 class="text-lg md:text-sm font-medium text-gray-700">Question <?= $current + 1 ?> of <?= count($questions) ?></h2>
            <form method="post">
                <p class="text-2xl md:text-xl leading-none font-medium py-4 text-gray-700"><?= htmlspecialchars($question['qns']) ?></p>

                <label class="text-lg md:text-sm font-medium text-gray-700 hover:bg-gradient-to-r from-[#191c9d] to-[#191c5c] hover:text-white"><input type="radio" name="answer" value="OptA" required> <?= htmlspecialchars($question['OptA']) ?></label>
                <label class="text-lg md:text-sm font-medium text-gray-700 hover:bg-gradient-to-r from-[#191c9d] to-[#191c5c] hover:text-white"><input type="radio" name="answer" value="OptB"> <?= htmlspecialchars($question['OptB']) ?></label>
                <label class="text-lg md:text-sm font-medium text-gray-700 hover:bg-gradient-to-r from-[#191c9d] to-[#191c5c] hover:text-white"><input type="radio" name="answer" value="OptC"> <?= htmlspecialchars($question['OptC']) ?></label>
                <label class="text-lg md:text-sm font-medium text-gray-700 hover:bg-gradient-to-r from-[#191c9d] to-[#191c5c] hover:text-white"><input type="radio" name="answer" value="OptD"> <?= htmlspecialchars($question['OptD']) ?></label>

                <button type="submit" class="w-[30%] bg-gradient-to-r from-[#191c9d] to-[#191c5c] text-white text-center text-2xl xl:text-xl font-semibold px-2 py-3 mt-3 rounded-lg hover:scale-105 transition">Next</button>
            </form>
            <!-- <div class="progress pt-3 text-[#191c5c] text-lg font-medium">Progress: <?= $current + 1 ?>/<?= count($questions) ?></div> -->
        </div>
    </div>
</body>

</html>