<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit;
}

$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$email = $_SESSION['email'];
$name = $_SESSION['name'] ?? 'User';

// Fetch technologies
$techResult = $link->query("SELECT tech_name FROM technologies ORDER BY tech_name ASC");

// Fetch recent results
$resultQuery = $link->prepare("SELECT tech_name, score, total, created_at FROM results WHERE email=? ORDER BY created_at DESC LIMIT 5");
$resultQuery->bind_param("s", $email);
$resultQuery->execute();
$userResults = $resultQuery->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .logo {
            font-family: "Pacifico", cursive;
            /* font-family: "Allison", cursive; */
        }
        
        th,
        td {
            border: 1px solid #e6e6ee;
            text-align: center;
        }

    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-[#191c5c] w-full h-[50px] fixed top-0 text-white px-6 py-4 flex justify-between items-center shadow-lg">
        <h1 class=" logo text-2xl font- tracking-wider italic text-white ">Quiz Time</h1>
        <div class="flex items-center gap-4">
            <span class="hidden md:flex text-gray-100 font-semibold">Welcome, <?= htmlspecialchars($name) ?> 👋</span>
            <a href="Logout.php" class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-sm font-semibold">Logout</a>
        </div>
    </nav>

    <!-- Page Layout -->
    <div class="w-full h-full flex flex-col gap-6 items-center justify-center py-4 mt-[50px]">

        <!-- Profile Card -->
        <div class="flex flex-col xl:flex-row gap-6 w-[80%] xl:w-[70%]">

            <div class="bg-white p-6 rounded-xl shadow-2xl w-full xl:w-[30%] ">
                <h2 class="text-xl font-semibold mb-4">👤 Profile</h2>
                <p class="text-sm"><b>Name :</b> <?= htmlspecialchars($name) ?></p>
                <p class="text-sm"><b>Email :</b> <?= htmlspecialchars($email) ?></p>
                <p class="mt-3 text-gray-600 text-sm ">Keep learning, keep growing 🚀</p>
            </div>

            <!-- Quiz Rules --> 
            <div class="bg-white p-6 rounded-xl shadow-2xl w-full xl:w-[70%]">
                <h2 class="text-xl font-semibold mb-4">📜 Quiz Rules</h2>
                <ul class="list-disc pl-6 space-y-2 text-sm text-gray-700">
                    <li>Once you submit a question, you <b>cannot go back</b>.</li>
                    <li>Each question has <b>only one correct answer</b>.</li>
                    <li>Do not refresh or close the window during the quiz.</li>
                    <li>Your <b>score will be saved</b> after completion.</li>
                    <li>User cannot retake the <b>same technology quiz within 5 minutes</b>.</li>
                </ul>
                <p class="mt-4 text-sm text-gray-500">✅ Please read the rules carefully before starting the quiz.</p>
            </div>
        </div>
        
        <div class="flex gap-6 w-[80%] xl:w-[70%] flex-col xl:flex-row">

            <div class="bg-white p-6 rounded-xl shadow-xl w-full xl:[50%]">
                <h2 class="text-xl font-semibold mb-4">🎯 Start a Quiz</h2>
                <div class="grid grid-cols-2 text-sm md:grid-cols-3 gap-4">
                    <?php if ($techResult && $techResult->num_rows > 0): ?>
                        <?php while ($row = $techResult->fetch_assoc()): ?>
                            <button onclick="confirmStart('<?= urlencode($row['tech_name']) ?>')"
                                class="block w-full bg-gradient-to-r from-[#191c9d] to-[#191c5c] text-white text-center font-semibold px-2 py-4 rounded-lg shadow hover:scale-105 hover:shadow-lg transition">
                                <?= htmlspecialchars($row['tech_name']) ?>
                            </button>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No technologies available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Results -->
            <div class="bg-white p-6 rounded-xl shadow-xl w-full xl:[50%]">
                <h2 class="text-xl font-semibold mb-4">📊 Recent Results</h2>
                <?php if ($userResults && $userResults->num_rows > 0): ?>
                    <table class="w-full text-left text-sm border-collapse rounded-md">
                        <thead>
                            <tr class="bg-[#191c5c] text-white rounded-md">
                                <th class="p-3">Technology</th>
                                <th class="p-3">Score</th>
                                <th class="p-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($res = $userResults->fetch_assoc()): ?>
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="p-3"><?= htmlspecialchars($res['tech_name']) ?></td>
                                    <td class="p-3"><?= $res['score'] ?>/<?= $res['total'] ?></td>
                                    <td class="p-3"><?= $res['created_at'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No results yet. Try a quiz!</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- Select Technology -->
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl p-6 max-w-sm text-center shadow-lg">
            <h2 class="text-xl font-bold mb-4">⚠️ Ready to Start?</h2>
            <p class="text-gray-600 mb-6">Have you read all the rules? Once you start, you cannot go back.</p>
            <div class="flex justify-center gap-4">
                <button onclick="closeModal()" class="bg-white text-[#191c5c] border-2 border-[#191c5c] font-semibold hover:bg-gray-200 px-4 py-2 rounded-md">Cancel</button>
                <a id="startLink" href="#" class="bg-[#191c5c] hover:bg-[#191c7c] bg-gradient-to-r from-[#191c9d] to-[#191c5c] text-white px-4 py-2 font-semibold rounded-md">Start Quiz</a>
            </div>
        </div>
    </div>

    <script>
        let selectedTech = "";

        function confirmStart(tech) {
            selectedTech = tech;
            document.getElementById("startLink").href = "quiz_1.php?tech=" + tech;
            document.getElementById("confirmModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("confirmModal").classList.add("hidden");
        }
    </script>
</body>

</html>