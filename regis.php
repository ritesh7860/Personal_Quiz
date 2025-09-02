<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WIN OR BOOZE</title>
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   <link href="css/style.css" rel="stylesheet" type="text/css" />
   <script type="text/javascript">
      function f() {
         var result = true;
         var a = document.frm.name.value;
         if (a == "") {
            document.getElementById('name').innerHTML = "*Enter Name";
            result = false;
         } else {
            document.getElementById('name').innerHTML = "";
         }
         a = document.frm.mail.value;
         if (a == "") {
            document.getElementById('mail').innerHTML = "*Enter Email";
            result = false;
         } else {
            document.getElementById('mail').innerHTML = "";
         }

         a = document.frm.pwd1.value;
         if (a == "") {
            document.getElementById('pwd').innerHTML = "*Enter Password";
            result = false;
         } else {
            document.getElementById('pwd').innerHTML = "";
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

      nav {
         padding: 0px 20px 0px 20px;
         font-size: 18px;
         font-family: cursive;
         background-color: #ad5fa7ff !important;
      }

      .hading {
         padding: 0 150px;
         float: right;
         color: #b0bed3;
         font-size: 40px;
         font-weight: 200;
         font-family: cursive;
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

      div form input[type=text],
      div form input[type=email],
      div form input[type=password] {
         background-color: white;
         color: black;
         border-radius: 10px;
      }




      div form input[type=text]:focus,
      div form input[type=email]:focus,
      div form input[type=password]:focus {
         border: 3px solid rgb(163, 170, 172);
         border-radius: 10px;
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
      <form align="center" method="post" name="frm" onsubmit="return f()"><br>
         <div class="hading">
            <h3 style="color: #ffffffff; font-weight:600; font-size:35px"> Create Your Account</h3>
            <hr>
            </hr>
         </div>

        <div style="display: flex; flex-direction:column; gap: 20px; padding-top: 10px; padding-bottom: 40px; width: 80%; margin: auto;">
         <div style="display: flex; justify-content:space-between">
          <label>Name :</label>
          <input type="text" placeholder=" Enter Your Name" name="name" id="name"/>
        </div>  
        <div style="display: flex; justify-content:space-between">
          <label>Email : </label>
          <input type="email" placeholder=" Enter Your Email" name="mail" id="mail"/> 
        </div>
        <div style="display: flex; justify-content:space-between">
          <label>Password :</label>
          <input type="password" placeholder="Enter Password" name="pwd1" id="pwd"/>
        </div>
      </div>
         <input type="submit" name="btn" value="CREATE ACCOUNT"><BR />
         <h4>OR <a href="login2.php"> LOGIN </a>...</h4>
      </form>
   </div>
</body>

</html>

<?php
extract($_REQUEST);
if (isset($btn)) {
   $link = mysqli_connect("localhost", "root", "", "quiz");
   $qry = "insert into regis values('$name','$mail','$pwd1')";
   $r = mysqli_query($link, $qry);

   if ($r) {
      echo '<span style="color:black  "><h2>ACCOUNT CREATED...</h2></span>';
   } else {
      echo   '<span style="color:black" style= "padding:1 100px"><h2>Try Again</h2></span>';
   }
   mysqli_close($link);
}
?>