<?php
include 'welcome.php';

$link = mysqli_connect("localhost", "root", "", "quiz");
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$qid = intval($_GET['qid']);
$result = mysqli_query($link, "SELECT * FROM question WHERE qid=$qid");
$row = mysqli_fetch_assoc($result);

// ✅ Fetch available technologies dynamically
$techResult = mysqli_query($link, "SELECT DISTINCT technology FROM question");
$technologies = [];
while ($t = mysqli_fetch_assoc($techResult)) {
    $technologies[] = $t['technology'];
}

// ✅ Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qns  = $_POST['ques'];
    $a    = $_POST['a'];
    $b    = $_POST['b'];
    $c    = $_POST['c'];
    $d    = $_POST['d'];
    $ans  = $_POST['ans'];
    $tech = $_POST['tech'];

    $stmt = $link->prepare("UPDATE question 
        SET qns=?, OptA=?, OptB=?, OptC=?, OptD=?, ans=?, technology=? 
        WHERE qid=?");
    $stmt->bind_param("sssssssi", $qns, $a, $b, $c, $d, $ans, $tech, $qid);
    $stmt->execute();
    $stmt->close();

    echo "<p style='color:lightgreen; text-align:center;'>✅ Question Updated Successfully!</p>";
    // header("Location: manage_questions.php");
    // exit;
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Question</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
    </style>
</head>

<body class="bg-gray-200">
    <div class="flex flex-col h-[88%] w-screen justify-center items-center mt-[10vh] 2xl:mt-[8vh]">
        <h2 class="font-medium text-[26px] mb-[20px]">Edit Question</h2>
        <form class="w-[50%] border-1 bg-white flex flex-col gap-2 border-red bg-[#e6e6e6] rounded-md p-4" method="post">
            
            <!-- Technology -->
            <div class="flex flex-col">
                <label class="text-md font-medium">Select Technology</label>
                <select class="cursor-pointer border-1 border-gray-400 text-gray-600 p-2 rounded-sm" name="tech" required>
                    <option value="" disabled>--Select--</option>
                    <?php foreach ($technologies as $t): ?>
                        <option value="<?= htmlspecialchars($t) ?>" <?= ($t == $row['technology']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($t) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Question -->
            <div class="flex flex-col">
                <label class="text-md font-medium">Question</label>
                <textarea class="border-1 focus:ring-1 outline-none border-gray-400 p-1.5 rounded-sm"
                          name="ques" required><?= htmlspecialchars($row['qns']) ?></textarea>
            </div>

            <!-- Options -->
            <div class="flex gap-3">
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option A</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm"
                           type="text" name="a" value="<?= htmlspecialchars($row['OptA']) ?>" required />
                </div>
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option B</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm"
                           type="text" name="b" value="<?= htmlspecialchars($row['OptB']) ?>" required />
                </div>
            </div>

            <div class="flex gap-3">
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option C</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm"
                           type="text" name="c" value="<?= htmlspecialchars($row['OptC']) ?>" required />
                </div>
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option D</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm"
                           type="text" name="d" value="<?= htmlspecialchars($row['OptD']) ?>" required />
                </div>
            </div>

            <!-- Correct Answer -->
            <div class="flex flex-col">
                <label class="text-md font-medium">Select the correct option</label>
                <select class="cursor-pointer border-1 border-gray-400 focus:ring-1 outline-none text-gray-600 p-2 rounded-sm" 
                        name="ans" required>
                    <option value="OptA" <?= $row['ans']=="OptA"?"selected":"" ?>>Option A</option>
                    <option value="OptB" <?= $row['ans']=="OptB"?"selected":"" ?>>Option B</option>
                    <option value="OptC" <?= $row['ans']=="OptC"?"selected":"" ?>>Option C</option>
                    <option value="OptD" <?= $row['ans']=="OptD"?"selected":"" ?>>Option D</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="mt-3 flex justify-center gap-2">
                <a href="manage_questions.php" 
                   class="px-[10%] py-2 text-[#191c5c] bg-gray-300 border-2 font-semibold border-[#191c5c] rounded-md cursor-pointer text-center">
                   Cancel
                </a>
                <input class="px-[10%] py-2 bg-[#191c5c] text-white font-semibold rounded-md cursor-pointer" 
                       type="submit" value="Update" />
            </div>

        </form>
    </div>
</body>
</html>
