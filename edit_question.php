<?php
$link = mysqli_connect("localhost", "root", "", "quiz");

$qid = intval($_GET['qid']);
$result = mysqli_query($link, "SELECT * FROM question WHERE qid=$qid");
$row = mysqli_fetch_assoc($result);

// Fetch available technologies
$techResult = mysqli_query($link, "SELECT DISTINCT technology FROM question");
$technologies = [];
while ($t = mysqli_fetch_assoc($techResult)) {
    $technologies[] = $t['technology'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qns = $_POST['qns'];
    $a = $_POST['OptA'];
    $b = $_POST['OptB'];
    $c = $_POST['OptC'];
    $d = $_POST['OptD'];
    $ans = $_POST['ans'];
    $tech = $_POST['technology'];

    $stmt = $link->prepare("UPDATE question 
        SET qns=?, OptA=?, OptB=?, OptC=?, OptD=?, ans=?, technology=? 
        WHERE qid=?");
    $stmt->bind_param("sssssssi", $qns, $a, $b, $c, $d, $ans, $tech, $qid);
    $stmt->execute();
    header("Location: manage_questions.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f7; padding: 30px; background-color: #191c5c;}
        .form-box { background: #fff; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="form-box">
    <h2>Edit Question</h2>
    <form method="post">
        <label>Question</label>
        <input type="text" name="qns" value="<?= htmlspecialchars($row['qns']) ?>">

        <label>Option A</label>
        <input type="text" name="OptA" value="<?= htmlspecialchars($row['OptA']) ?>">

        <label>Option B</label>
        <input type="text" name="OptB" value="<?= htmlspecialchars($row['OptB']) ?>">

        <label>Option C</label>
        <input type="text" name="OptC" value="<?= htmlspecialchars($row['OptC']) ?>">

        <label>Option D</label>
        <input type="text" name="OptD" value="<?= htmlspecialchars($row['OptD']) ?>">

        <label>Correct Answer</label>
        <select name="ans">
            <option value="OptA" <?= $row['ans']=="OptA"?"selected":"" ?>>Option A</option>
            <option value="OptB" <?= $row['ans']=="OptB"?"selected":"" ?>>Option B</option>
            <option value="OptC" <?= $row['ans']=="OptC"?"selected":"" ?>>Option C</option>
            <option value="OptD" <?= $row['ans']=="OptD"?"selected":"" ?>>Option D</option>
        </select>

        <label>Technology</label>
        <select name="technology">
            <?php foreach ($technologies as $t): ?>
                <option value="<?= htmlspecialchars($t) ?>" <?= ($t==$row['technology'])?"selected":"" ?>>
                    <?= htmlspecialchars($t) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update Question</button>
    </form>
</div>
</body>
</html>
