<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            text-align: center;
            padding: 50px;
        }
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            padding: 40px;
            width: 400px;
            margin: auto;
        }
        h2 {
            margin-bottom: 20px;
        }
        .btn {
            display: block;
            background: #4CAF50;
            color: white;
            padding: 12px 25px;
            margin: 15px auto;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            width: 80%;
            text-decoration: none;
        }
        .btn:hover {
            background: #45a049;
        }
        .logout {
            margin-top: 20px;
            display: inline-block;
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['email']) ?>!</h2>
        <p>Select a technology to start your quiz:</p>

        <a href="quiz_1.php?tech=C" class="btn">C Language</a>
        <a href="quiz_1.php?tech=PHP" class="btn">PHP Language</a>
        <a href="quiz_1.php?tech=Java" class="btn">Java</a>
        <a href="quiz_1.php?tech=Python" class="btn">Python</a>
        <a href="quiz_1.php?tech=Html" class="btn">HTML</a>

        <a href="Logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
