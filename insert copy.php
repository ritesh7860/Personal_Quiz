<?php
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
    <title>WIN OR BOOZE - Insert</title>
    <style>
        body {
            background-color: #124170;
            font-family: Arial, sans-serif;
            color: white;
        }
        h1 {
            color: yellow;
        }
        table {
            background: #1f2e4a;
            padding: 20px;
            border-radius: 10px;
        }
        td {
            padding: 10px;
        }
        input, select {
            padding: 5px;
            border-radius: 5px;
            border: none;
        }
        input[type="submit"] {
            background: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
    </style>
</head>

<body>
    <br><br><br><br>
    <center>
        <h1>Insert Question</h1>
    </center>
    <br>
    <hr>
    <table align="center" border="0" cellspacing="0">
        <form name="fr1" method="post">
            <tr>
                <td>Question:</td>
                <td><textarea name="ques" placeholder="Enter question" required ></textarea></td>
            </tr>
            <tr>
                <td>OptA</td>
                <td><input type="text" name="a" placeholder="Option A" required /></td>
            </tr>
            <tr>
                <td>OptB</td>
                <td><input type="text" name="b" placeholder="Option B" required /></td>
            </tr>
            <tr>
                <td>OptC</td>
                <td><input type="text" name="c" placeholder="Option C" required /></td>
            </tr>
            <tr>
                <td>OptD</td>
                <td><input type="text" name="d" placeholder="Option D" required /></td>
            </tr>
            <tr>
                <td>Answer</td>
                <td>
                    <select name="ans" required>
                        <option value="">-- Select Correct Answer --</option>
                        <option value="OptA">Option A</option>
                        <option value="OptB">Option B</option>
                        <option value="OptC">Option C</option>
                        <option value="OptD">Option D</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Technology</td>
                <td>
                    <select name="tech" required>
                        <option value="">-- Select Technology --</option>
                        <option value="C">C Language</option>
                        <option value="PHP">PHP</option>
                        <option value="Java">Java</option>
                        <option value="Python">Python</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="s1" value="Insert" /></td>
            </tr>
        </form>
    </table>
</body>
</html>
