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
            background-color: #191c5c;
            /* background-color: #000; */
            /* color: #e6e6ee; */
        }
    </style>
</head>

<body>
    <div class="flex w-screen h-[8%] justify-between items-center bg-[#e6e6e6] px-5 py-3">
        <div>
            <img class="w-[40px] h-[40px] rounded-full" src="https://t4.ftcdn.net/jpg/02/50/32/43/360_F_250324355_6nh8Q5iUdb499Q4v79hYMEcSlFpIBhn7.jpg">
        </div>
        <div>
            <p class="text-[#191c5c] font-medium">Admin Login</p>
        </div>
    </div>
    <div class="flex flex-col h-[88%] w-screen justify-center items-center">
        <form class="w-[50%] border-1 flex flex-col gap-2 border-red bg-[#e6e6e6] rounded-md p-4" name="fr1" method="post">
            <div class="flex flex-col">
                <label class="text-md font-medium">Select Technology</label>
                <select class="border-1 border-gray-400 text-gray-600 p-2 rounded-sm" name="" id="">
                    <option value="">--Select--</option>
                    <option value="java">Java</option>
                    <option value="c">C</option>
                    <option value="c++">C++</option>
                    <option value="php">PHP</option>
                    <option value="python">Python</option>
                    <option value="html">HTML</option>
                    <option value="css">CSS</option>
                    <option value="javascript">JavaScript</option>
                </select>
            </div>
            <div class="flex flex-col">
                <label class="text-md font-medium">Question</label>
                <textarea class="border-1 focus:ring-1 outline-none border-gray-400 p-1.5 rounded-sm" type="text" name="ques" placeholder="Enter question:" ></textarea>
            </div>
            <div class="flex gap-3">
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option A</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="a" placeholder="Enter option" />
                </div>
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option B</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="b" placeholder="Enter option" />
                </div>
            </div>
            <div class="flex gap-3">
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option C</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="c" placeholder="Enter option" />
                </div>
                <div class="flex flex-col w-[50%]">
                    <label class="text-md font-medium">Option D</label>
                    <input class="border-1 border-gray-400 focus:ring-1 outline-none p-1.5 rounded-sm" type="text" name="d" placeholder="Enter option" />
                </div>
            </div>
            
            
            <div class="flex flex-col">
                <label class="text-md font-medium">Select the correct option</label>
                <select class="border-1 border-gray-300 focus:ring-1 outline-none text-gray-600 p-2 rounded-sm" name="ans" id="">
                    <option value="">--Select--</option>
                    <option value="OptA">Option A</option>
                    <option value="OptB">Option B</option>
                    <option value="OptC">Option C</option>
                    <option value="OptD">Option D</option>
                </select>
                <!-- <input class="border-1 p-1.5 rounded-sm" type="text" name="ans" placeholder="ans" /> -->
            </div>
            <div class="mt-3 flex justify-center gap-2">
                <input class="px-25 py-2 text-[#191c5c] bg-gray-300 border-2 font-semibold border-[#191c5c] rounded-md" type="submit" name="s1" value="Reset" />
                <input class="px-25 py-2 bg-[#191c5c] text-white font-semibold rounded-md" type="submit" name="s1" value="Save" />
            </div>

        </form>
    </div>


</body>

</html>


<?php
extract($_REQUEST);
if (isset($s1)) {

    $link = mysqli_connect("localhost", "root", "", "quiz");
    $qry = "insert into question values('$qno','$ques','$a','$b','$c','$d','$ans')";
    $r = mysqli_query($link, $qry);

    mysqli_close($link);

    echo "Record Added...";
}



?>