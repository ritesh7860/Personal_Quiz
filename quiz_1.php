<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login2.php");
    exit;
}
$link = mysqli_connect("localhost", "root", "", "quiz");
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch questions only once and store in session
if (!isset($_SESSION['questions'])) {
    $resultset = mysqli_query($link, "SELECT * FROM question ORDER BY qid");
    $questions = [];
    while ($r = mysqli_fetch_assoc($resultset)) {
        $questions[] = $r;
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

    if ($selected === $correctAnswer) {
        $_SESSION['correct']++;
    }

    $_SESSION['current']++;

    // If finished, go to result page
    if ($_SESSION['current'] >= count($questions)) {
        header("Location: result.php");
        exit;
    } else {
        header("Location: quiz_1.php");
        exit;
    }
}

$question = $questions[$current];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .quiz-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 500px;
            padding: 30px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
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
        label:hover {
            background: #e0e0e0;
        }
        .btn {
            background: #4CAF50;
            color: white;
            padding: 12px 25px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background: #45a049;
        }
        .progress {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="quiz-container">
    <h2>Question <?= $current+1 ?> of <?= count($questions) ?></h2>
    <form method="post">
        <p style="font-size:18px;"><?= htmlspecialchars($question['qns']) ?></p>

        <label><input type="radio" name="answer" value="OptA" required> <?= htmlspecialchars($question['OptA']) ?></label>
        <label><input type="radio" name="answer" value="OptB"> <?= htmlspecialchars($question['OptB']) ?></label>
        <label><input type="radio" name="answer" value="OptC"> <?= htmlspecialchars($question['OptC']) ?></label>
        <label><input type="radio" name="answer" value="OptD"> <?= htmlspecialchars($question['OptD']) ?></label>

        <button type="submit" class="btn">Next</button>
    </form>
    <div class="progress">Progress: <?= $current+1 ?>/<?= count($questions) ?></div>
</div>

</body>
</html>
