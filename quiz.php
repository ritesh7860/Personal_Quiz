<html>

<head>
</head>
<style>
    .btn {}

    th {
        background-color: lightgrey;
        text-align: left;
        padding-left: 20px;
        border-bottom: 3px solid navy;
    }
</style>

<body style="background-color:lightblue;">
    <form method="post" name="myfrm">
        <?php //include_once("navBar.html"); 
        ?>

        <table border="2px" style="border-color: white; position: absolute;top: 80px;left:400px;font-size: larger;background-color: aliceblue;box-shadow:0px 0px 10px 5px grey;">
            <?php

            $link = mysqli_connect("localhost", "root", "", "quiz");
            $resultset = mysqli_query($link, "select * from question order by qid");
            //$count=mysqli_num_rows($resultset);
            $c = 0;
            $qid = array();
            $ans = array();
            while ($r = mysqli_fetch_assoc($resultset)) {
                array_push($qid, 'qns' . $r['qid']);

            ?>

                <tr>
                    <th><?php echo ++$c, ". " . $r['qns'] ?></th>
                </tr>
                <tr>
                    <td><input required type="radio" value="OptA" name="<?php echo "qns" . $r['qid'];  ?>" /><?php echo $r['OptA'] ?> </td>
                </tr>
                <tr>
                    <td><input type="radio" value="OptB" name="<?php echo "qns" . $r['qid'];  ?>" /><?php echo $r['OptB'] ?> </td>
                </tr>
                <tr>
                    <td><input type="radio" value="OptC" name="<?php echo "qns" . $r['qid'];  ?>" /><?php echo $r['OptC'] ?> </td>
                </tr>
                <tr>
                    <td><input type="radio" value="OptD" name="<?php echo "qns" . $r['qid'];  ?>" /><?php echo $r['OptD'] ?> </td>
                </tr>


            <?php
                array_push($ans, $r['ans']);
            }
            ?>
            <tr>
                <td align="center"><input type="submit" name="subBtn" class="btn" value="Submit Quiz" />

                    <?php
                    extract($_REQUEST);
                    $corr = 0;
                    $w = 0;
                    if (isset($subBtn)) {

                        for ($i = 0; $i < count($ans); $i++) {
                            if ($$qid[$i] == $ans[$i])
                                $corr++;
                        }
                        $w = ($c - $corr);
                    }

                    echo "<tr style='color:green;text-align:center;font-size:30px;'><td> Correct Answers : $corr</td></tr>";
                    ?>