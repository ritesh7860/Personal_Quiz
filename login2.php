<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
    function f1() {
      var result = true;
      var a = document.frm1.umail.value;
      if (a == "") {
        document.getElementById('umailMsg').innerHTML = "*Enter Email";
        console.log("document.getElementById('umail')", document.getElementById('umail'))
        result = false;
      } else {
        document.getElementById('umailMsg').innerHTML = "";
      }
      a = document.frm1.pass.value;
      if (a == "") {
        document.getElementById('passMSG').innerHTML = "*Enter Password";
        console.log("document.getElementById('pass')", document.getElementById('pass'))
        result = false;
      } else {
        document.getElementById('passMSG').innerHTML = "";
      }
      return result;
    }
  </script>
  <style>
    body {

      background-image: black;
      background-image: url('background.avif');
      background-size: cover;
      background-attachment: fixed;
    }

    input,
    select,
    textarea {
      color: black;
    }

    nav {
      padding: 0px 20px 0px 20px;
      font-size: 18px;
      font-family: cursive;
      background-color: #ad5fa7ff !important;
    }

    .form {
      color: #ffffffff;
      font-size: 16px;
      position: absolute;
      right: 30%;
      bottom: 20%;
      width: 35%;
      height: 38%;
      top: 35%;
      border: 0px solid gray;

    }

    div form input[type=submit] {
      border: 2px solid rgb(71, 80, 82);
      background-color: #ad5fa7;
      color: #ffffffff;
      font-size: 14px;
      border-radius: 10px;
      font-weight: 700;
      padding: 3px 50px;
    }

    div form input[type=email],
    div form input[type=password] {

      background-color: white;
      font-size: 16px;
    }

    hr {
      border-top: 3px solid rgba(0, 0, 0, 1);
    }

    div form input[type=email]:focus,
    div form input[type=password]:focus {
      border: 3px solid rgb(163, 170, 172);
      border-radius: 10px;
    }

    div form input[type=email],
    div form input[type=password] {

      border-radius: 10px;
    }

    a {
      color: #ffffffff !important;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <ul class="nav navbar-nav">
          <li><a href="login2.php">Home</a></li>
          <li><a href="regis.php">Register</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">FAQ</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#">Logout</a></li>
        </ul>
      </div>
    </nav>
  </div>


  <div class="form">
    <form align="center" name="frm1" onsubmit="return f1()">
      <div class="hading">
        <h3 style="color: #ffffffff; font-weight:600; font-size:35px"> ENTER YOUR DETAIL</h3>
        <hr>
        </hr>
      </div>
      <div style="display: flex; flex-direction:column; gap: 20px; padding-top: 10px; padding-bottom: 40px; width: 80%; margin: auto;">
        <div style="display: flex; justify-content:space-between">
          <label>Email : </label>
          <div style="display:flex; flex-direction:column;">
            <input type="email" placeholder="Enter Your Email" name="umail" id="umail" />
            <span id="umailMsg" style="color:red"></span>
          </div>
        </div>
        <div style="display: flex; justify-content:space-between">
          <label>Password :</label>
          <div style="display:flex; flex-direction:column;">
            <input type="password" placeholder="Enter Password" name="pass" id="pass" />
            <span id="passMSG" style="color:red"></span>
          </div>
        </div>
      </div>
      <input type="submit" name="logBtn" value="Login">
      <h6 style="color:blue"> <a href="regis.php" style="color:red !important; text-decoration:none;">CREATE AN ACCOUNT </a>...</h6>
    </form>
  </div>
</body>

</html>
<?php
extract($_REQUEST);
if (isset($logBtn)) {
  $link = mysqli_connect("localhost", "root", "", "quiz");
  $qry = "select email from regis where email='$umail' and  password='$pass'";
  $r = mysqli_query($link, $qry);
  $c = mysqli_num_rows($r);
  if ($c == 1) {

    $r = mysqli_query($link, $qry);
    session_start();
    $_SESSION['email'] = $umail;
    header("location:quiz.php");
    echo $a[0];
  } else {
    echo "Invalid email or password";
  }
}
?>