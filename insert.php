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
            /* color: #e6e6ee; */
        }
    </style>
</head>

<body>
    <div class="flex flex-col h-screen w-screen justify-center items-center">
        <form class="w-[400px] border-1 border-red bg-[#e6e6e6] rounded-sm p-3" name="fr1" method="post">
            <div class="flex flex-col">
                <label>Question</label>
                <textarea class="border-1 p-1.5 rounded-sm" type="text" name="ques" placeholder="Enter ques:" ></textarea>
            </div>
            <div class="flex flex-col">
                <label>OptA</label>
                <input class="border-1 p-1.5 rounded-sm" type="text" name="a" placeholder="option A" />
            </div>
            <div class="flex flex-col">
                <label>OptB</label>
                <input class="border-1 p-1.5 rounded-sm" type="text" name="b" placeholder="option B" />
            </div>
            <div class="flex flex-col">
                <label>OptC</label>
                <input class="border-1 p-1.5 rounded-sm" type="text" name="c" placeholder="option C" />
            </div>
            <div class="flex flex-col">
                <label>OptD</label>
                <input class="border-1 p-1.5 rounded-sm" type="text" name="d" placeholder="option D" />
            </div>
            <div class="flex flex-col">
                <label>ans</label>
                <input class="border-1 p-1.5 rounded-sm" type="text" name="ans" placeholder="ans" />
            </div>
            <div>
                <input class="px-25 py-2 bg-[#191c5c] text-white rounded-md" type="submit" name="s1" value="Insert" />
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