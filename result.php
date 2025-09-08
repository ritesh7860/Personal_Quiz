<?php
session_start();
if (!isset($_SESSION['questions']) || !isset($_SESSION['email'])) {
    header("Location: login2.php");
    exit;
}

$link = mysqli_connect("localhost", "root", "", "quiz");
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$total = count($_SESSION['questions']);
$correct = $_SESSION['correct'];
$wrong = $total - $correct;

// ✅ Save result to database
$stmt = $link->prepare("INSERT INTO results (email, score, total) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $email, $correct, $total);
$stmt->execute();
$stmt->close();

// ✅ Fetch latest result for this user
$res = mysqli_query($link, "SELECT * FROM results WHERE email='$email' ORDER BY id DESC LIMIT 1");
$resultData = mysqli_fetch_assoc($res);

// ✅ Clear quiz session (optional, but keep email for login)
unset($_SESSION['questions']);
unset($_SESSION['current']);
unset($_SESSION['correct']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quiz Result</title>
    <style>
        body {
            background: linear-gradient(to right, #ff9a9e, #fad0c4);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 450px;
            padding: 30px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .score {
            font-size: 20px;
            margin: 10px 0;
        }
        .btn {
            background: #007BFF;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="result-container">
    <h2>Quiz Result for <?= htmlspecialchars($email) ?></h2>
    <div class="score">✅ Correct Answers: <?= $resultData['score'] ?> / <?= $resultData['total'] ?></div>
    <div class="score">❌ Wrong Answers: <?= $resultData['total'] - $resultData['score'] ?></div>
    <div class="score">📅 Taken on: <?= $resultData['created_at'] ?></div>

    <a href="Login.php" class="btn">Log Out</a>
</div>

</body>
</html>
