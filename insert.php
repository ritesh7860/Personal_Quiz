<?php
include 'welcome.php';

if (isset($_POST['s1'])) {
    $ques = $_POST['ques'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $ans = $_POST['ans'];
    $tech = $_POST['tech'];

    $link = mysqli_connect("localhost", "root", "", "quiz");

    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $qry = "INSERT INTO question (qns, OptA, OptB, OptC, OptD, ans, technology) 
            VALUES ('$ques','$a','$b','$c','$d','$ans','$tech')";

    $r = mysqli_query($link, $qry);

    if ($r) {
        echo "<p style='color:lightgreen; text-align:center;'>✅ Record Added Successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Error: " . mysqli_error($link) . "</p>";
    }

    mysqli_close($link);
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WIN OR BOOZE</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
    </style>
</head>

<body class="bg-gray-200">
    <div class="flex flex-col h-[88%] w-screen justify-center items-center mt-[50px] py-2">
        <h2 class="font-medium text-[26px]">Create Questions</h2>
        
        <form class="w-[90%] md:w-[80%] xl:w-[60%] bg-white flex flex-col gap-2 bg-[#e6e6e6] rounded-md p-4 shadow-lg mt-2 " name="fr1" method="post">
            
            <!-- Technology Dropdown -->
            <div class="flex flex-col">
                <label class="text-md font-medium">Select Technology</label>
                <select class="cursor-pointer border-1 border-gray-300 text-gray-600 p-2 rounded-sm" name="tech" required>
                    <option value="" selected disabled>--Select--</option>
                    <?php
                    $link = mysqli_connect("localhost", "root", "", "quiz");
                    if (!$link) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $techQuery = "SELECT tech_name FROM technologies ORDER BY tech_name ASC";
                    $techResult = mysqli_query($link, $techQuery);

                    if ($techResult && mysqli_num_rows($techResult) > 0) {
                        while ($row = mysqli_fetch_assoc($techResult)) {
                            echo "<option value='" . htmlspecialchars($row['tech_name']) . "'>" . htmlspecialchars($row['tech_name']) . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No Technologies Found</option>";
                    }
                    mysqli_close($link);
                    ?>
                </select>
            </div>

            <!-- Question -->
            <div class="flex flex-col">
                <label class="text-md font-medium">Question</label>
                <textarea class="border-1 focus:ring-1 outline-none border-gray-300 p-1.5 rounded-sm" 
                          name="ques" placeholder="Enter question" required></textarea>
            </div>

            <!-- Options A & B -->
            <div class="flex flex-col md:flex-row gap-3">
                <div class="flex flex-col w-full md:w-[50%]">
                    <label class="text-md font-medium">Option A</label>
                    <input class="border-1 border-gray-300 focus:ring-1 outline-none p-1.5 rounded-sm" 
                           type="text" name="a" placeholder="Enter option" required />
                </div>
                <div class="flex flex-col w-full md:w-[50%]">
                    <label class="text-md font-medium">Option B</label>
                    <input class="border-1 border-gray-300 focus:ring-1 outline-none p-1.5 rounded-sm" 
                           type="text" name="b" placeholder="Enter option" required />
                </div>
            </div>

            <!-- Options C & D -->
            <div class="flex flex-col md:flex-row  gap-3">
                <div class="flex flex-col w-full md:w-[50%]">
                    <label class="text-md font-medium">Option C</label>
                    <input class="border-1 border-gray-300 focus:ring-1 outline-none p-1.5 rounded-sm" 
                           type="text" name="c" placeholder="Enter option" required />
                </div>
                <div class="flex flex-col w-full md:w-[50%]">
                    <label class="text-md font-medium">Option D</label>
                    <input class="border-1 border-gray-300 focus:ring-1 outline-none p-1.5 rounded-sm" 
                           type="text" name="d" placeholder="Enter option" required />
                </div>
            </div>
            
            <!-- Correct Answer -->
            <div class="flex flex-col">
                <label class="text-md font-medium">Select the correct option</label>
                <select class="cursor-pointer border-1 border-gray-300 focus:ring-1 outline-none text-gray-600 p-2 rounded-sm" 
                        name="ans" required>
                    <option value="" disabled selected>--Select--</option>
                    <option value="OptA">Option A</option>
                    <option value="OptB">Option B</option>
                    <option value="OptC">Option C</option>
                    <option value="OptD">Option D</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="mt-3 flex justify-center gap-2">
                <input class="px-[10%] py-2 text-[#191c5c] bg-white hover:bg-[#e6e6e6] border-2 font-semibold border-[#191c5c] rounded-md cursor-pointer" 
                       type="reset" value="Reset" />
                <input class="px-[10%] py-2 bg-[#191c5c] hover:bg-[#191c7c] border-2  border-[#191c5c] text-white font-semibold rounded-md cursor-pointer" 
                       type="submit" name="s1" value="Save" />
            </div>

        </form>
    </div>
</body>
</html>
