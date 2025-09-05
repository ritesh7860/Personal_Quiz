<?php
declare(strict_types=1);
ini_set('display_errors','1');
error_reporting(E_ALL);

$link = mysqli_connect("localhost", "root", "", "quiz");
if (!$link) {
    die("Database connection failed: " . mysqli_connect_error());
}

// --- Fetch questions ---
$resultset = mysqli_query($link, "SELECT * FROM question ORDER BY qid");
$questions = [];
while ($r = mysqli_fetch_assoc($resultset)) {
    $questions[] = $r;
}

// --- Initialize results ---
$corr = null; // null means not submitted yet
$total = count($questions);

// --- If submitted, evaluate answers ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subBtn'])) {
    $corr = 0;
    foreach ($questions as $q) {
        $qidKey = "qns" . $q['qid'];
        if (!empty($_POST[$qidKey]) && $_POST[$qidKey] === $q['ans']) {
            $corr++;
        }
    }
    $wrong = $total - $corr;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <style>
        th {
            background-color: lightgrey;
            text-align: left;
            padding-left: 20px;
            border-bottom: 3px solid navy;
        }
    </style>
</head>
<body style="background-color:lightblue;">

    <form method="post" name="myfrm">
        <table border="2px" style="border-color: white; position: absolute;top: 80px;left:400px;font-size: larger;background-color: aliceblue;box-shadow:0px 0px 10px 5px grey;">
            <?php $c = 0; foreach ($questions as $q): ?>
                <tr>
                    <th><?= ++$c ?>. <?= htmlspecialchars($q['qns']) ?></th>
                </tr>
                <tr>
                    <td><input required type="radio" value="OptA" name="qns<?= $q['qid'] ?>" /><?= htmlspecialchars($q['OptA']) ?></td>
                </tr>
                <tr>
                    <td><input type="radio" value="OptB" name="qns<?= $q['qid'] ?>" /><?= htmlspecialchars($q['OptB']) ?></td>
                </tr>
                <tr>
                    <td><input type="radio" value="OptC" name="qns<?= $q['qid'] ?>" /><?= htmlspecialchars($q['OptC']) ?></td>
                </tr>
                <tr>
                    <td><input type="radio" value="OptD" name="qns<?= $q['qid'] ?>" /><?= htmlspecialchars($q['OptD']) ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td align="center">
                    <input type="submit" name="subBtn" class="btn" value="Submit Quiz" />
                </td>
            </tr>

            <?php if ($corr !== null): ?>
                <tr style="color:green;text-align:center;font-size:30px;">
                    <td>Correct Answers : <?= $corr ?> / <?= $total ?></td>
                </tr>
                <tr style="color:red;text-align:center;font-size:30px;">
                    <td>Wrong Answers : <?= $wrong ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </form>

</body>
</html>
