<?php
session_start();
if (!isset($_SESSION['questions']) || !isset($_SESSION['answers'])) {
    echo "<p style='text-align:center;color:red;'>❌ No quiz data found. Please take the quiz first.</p>";
    exit;
}

$questions = $_SESSION['questions']; // Array of questions
$userAnswers = $_SESSION['answers']; // Array of user answers
$email = $_SESSION['email'];
$name = $_SESSION['name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz Review</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');

        .logo {
            font-family: "Pacifico", cursive;
            /* font-family: "Allison", cursive; */
        }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            /*  padding: 20px; */
        }

        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #191c5c;
            color: white;
            padding: 15px 20px;
            text-align: center;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .container {
            margin: auto;
            max-width: 900px;
        }

        .question-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .q-text {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .option {
            padding: 10px;
            margin: 5px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .correct {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
            font-weight: bold;
        }

        .wrong {
            background: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="h-[50px] min-h-[50px] bg-[#191c5c] text-white px-6 py-4 flex justify-between items-center shadow-lg">
        <h1 class=" logo text-2xl font- tracking-wider italic text-white ">Quiz Time</h1>
        <div class="flex items-center gap-4">
            <span class="text-gray-100 hidden md:flex font-semibold">Welcome, <?= htmlspecialchars($name) ?> 👋</span>
            <a href="Logout.php" class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-sm font-semibold">Logout</a>
        </div>
    </nav>
    <div class="mt-[60px]">
        <div class="container p-3">

            <h2 style="text-align:center; margin-bottom:30px;">📘 Quiz Review</h2>

            <?php foreach ($questions as $i => $q):
                $userAns = $userAnswers[$i] ?? null;
                $correctAns = $q['ans'];
            ?>
                <div class="question-box">
                    <div class="q-text">Q<?= $i + 1 ?>: <?= htmlspecialchars($q['qns']) ?></div>

                    <?php foreach (['OptA', 'OptB', 'OptC', 'OptD'] as $optKey):
                        $optValue = $q[$optKey];
                        $classes = "option";

                        if ($optKey === $userAns && $userAns === $correctAns) {
                            $classes .= " correct"; // ✅ User correct
                        } elseif ($optKey === $userAns && $userAns !== $correctAns) {
                            $classes .= " wrong"; // ❌ User wrong
                        } elseif ($optKey === $correctAns) {
                            $classes .= " correct"; // ✅ Always show correct
                        }
                    ?>
                        <div class="<?= $classes ?>"><?= htmlspecialchars($optValue) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <div class="flex justify-end gap-5">
                <button class="px-4 py-2 text-[#191c5c] hover:bg-gray-200 bg-white border-2 border-[#191c5c] font-semibold rounded-md"> <a href="User_Home.php">Home</a></button>
                <button class="px-4 py-2 bg-[#191c5c] hover:bg-[#191c7c] text-white border-2 border-[#191c5c] font-semibold rounded-md"> <a href="result.php">Result</a></button>
            </div>
        </div>
    </div>
</body>

</html>