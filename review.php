<?php
session_start();
if (!isset($_SESSION['questions']) || !isset($_SESSION['answers'])) {
    echo "<p style='text-align:center;color:red;'>❌ No quiz data found. Please take the quiz first.</p>";
    exit;
}

$questions = $_SESSION['questions']; // Array of questions
$userAnswers = $_SESSION['answers']; // Array of user answers
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        .question-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
<div class="container">
    <h2 style="text-align:center; margin-bottom:30px;">📘 Quiz Review</h2>

    <?php foreach ($questions as $i => $q): 
        $userAns = $userAnswers[$i] ?? null;
        $correctAns = $q['ans']; 
    ?>
    <div class="question-box">
        <div class="q-text">Q<?= $i+1 ?>: <?= htmlspecialchars($q['qns']) ?></div>
        
        <?php foreach (['OptA','OptB','OptC','OptD'] as $optKey): 
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
</div>
</body>
</html>
