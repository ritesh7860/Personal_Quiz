<html>
<head>
    <title>WIN OR BOOZE - Insert</title>
</head>

<body>
    <br><br><br><br>
    <center>
        <h1>Insert</h1>
    </center>
    <br>
    <hr>
    <table align="center" border="3" cellspacing="0">
        <form name="fr1" method="post">
            <tr>
                <td>qid:</td>
                <td><input type="text" name="qno" placeholder="ques id" /></input></td>
            </tr>
            <tr>
                <td>qns:</td>
                <td><input type="text" name="ques" placeholder="Enter ques:" /></input></td>
            </tr>
            <tr>
                <td>OptA</td>
                <td><input type="text" name="a" placeholder="option A" /></input></td>
            </tr>
            <tr>
                <td>OptB</td>
                <td><input type="text" name="b" placeholder="option B" /></input></td>
            </tr>
            <tr>
                <td>OptC</td>
                <td><input type="text" name="c" placeholder="option C" /></input></td>
            </tr>
            <tr>
                <td>OptD</td>
                <td><input type="text" name="d" placeholder="option D" /></input></td>
            </tr>
            <tr>
                <td>ans</td>
                <td><input type="text" name="ans" placeholder="ans" /></input></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="s1" value="Insert" /></input></td>
            </tr>

        </form>
    </table>


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