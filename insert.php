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
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body{
            background-color:rgba(230, 251, 255, 0.88);
            /* background-color: #000; */
            /* color: #e6e6ee; */
        }
    </style>
</head>

<body>
    <!-- <div class="flex w-screen h-[8%] justify-between items-center bg-[#e6e6e6] px-5 py-3">
        <div>
            <img class="w-[40px] h-[40px] rounded-full" src="https://t4.ftcdn.net/jpg/02/50/32/43/360_F_250324355_6nh8Q5iUdb499Q4v79hYMEcSlFpIBhn7.jpg">
        </div>
        <div>
            <p class="text-[#191c5c] font-medium">Admin Login</p>
        </div>
    </div> -->
    <div class="flex flex-col h-[88%] w-screen justify-center items-center mt-[12%]">
        <form class="w-[50%] border-1 flex flex-col gap-2 border-red bg-[#e6e6e6] rounded-md p-4" name="fr1" method="post">
            <div class="flex flex-col">
                <label class="text-md font-medium">Select Technology</label>
                <select class="border-1 border-gray-400 text-gray-600 p-2 rounded-sm" name="tech" required>
                    <option value="" selected disabled>--Select--</option>
                    <option value="Java">Java</option>
                    <option value="C">C</option>
                    <option value="PHP">PHP</option>
                    <option value="Python">Python</option>
                    <option value="Html">HTML</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label class="text-md font-medium">Question</label>
                <textarea class="border-1 focus:ring-1 outline-none border-gray-400 p-1.5 rounded-sm" type="text" name="ques" placeholder="Enter question" required></textarea>
            </div>
            <div class="flex gap-3">
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option A</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="a" placeholder="Enter option" required />
                </div>
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option B</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="b" placeholder="Enter option" required />
                </div>
            </div>
            <div class="flex gap-3">
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option C</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="c" placeholder="Enter option" required />
                </div>
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option D</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="d" placeholder="Enter option" required />
                </div>
            </div>
            
            
            <div class="flex flex-col">
                <label class="text-md font-medium">Select the correct option</label>
                <select class="border-1 border-gray-300 focus:ring-1 outline-none text-gray-600 p-2 rounded-sm" name="ans" required>
                    <option value="" disabled selected>--Select--</option>
                    <option value="OptA">Option A</option>
                    <option value="OptB">Option B</option>
                    <option value="OptC">Option C</option>
                    <option value="OptD">Option D</option>
                </select>
                <!-- <input class="border-1 p-1.5 rounded-sm" type="text" name="ans" placeholder="ans" /> -->
            </div>
            <div class="mt-3 flex justify-center gap-2">
                <input class="px-25 py-2 text-[#191c5c] bg-gray-300 border-2 font-semibold border-[#191c5c] rounded-md cursor-pointer" type="reset" name="reset" value="Reset" />
                <input class="px-25 py-2 bg-[#191c5c] text-white font-semibold rounded-md cursor-pointer" type="submit" name="s1" value="Save" />
            </div>

        </form>
    </div>


</body>

</html>
