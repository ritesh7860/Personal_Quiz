<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>WIN OR BOOZE</title>
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
   <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
   <style>
    .main{
      background-image: url("https://t4.ftcdn.net/jpg/04/39/13/37/360_F_439133751_qALNX4ZKuphjpCLPGtASIvoUxwUNLxk2.jpg");
      background-repeat: no-repeat;
      /* background-position: center center; */
      background-size: cover;
      background-attachment: fixed;
      
    }
  </style>
</head>

<body>
   <div class="form main h-screen w-screen ">
      <form align="center" method="post" name="frm" onsubmit="return f()">
         <div class="hading">
            <h3 style="color: #ffffffff; font-weight:600; font-size:35px"> Create Your Account</h3>
            <hr>
            </hr>
         </div>

         <div style="display: flex; flex-direction:column; gap: 20px; padding-bottom: 40px; width: 80%; margin: auto;">
            <div style="display: flex; justify-content:space-between">
               <label>Name :</label>
               <input type="text" placeholder=" Enter Your Name" name="name" id="name" />
            </div>
            <div style="display: flex; justify-content:space-between">
               <label>Email : </label>
               <input type="email" placeholder=" Enter Your Email" name="mail" id="mail" />
            </div>
            <div style="display: flex; justify-content:space-between">
               <label>Password :</label>
               <input type="password" placeholder="Enter Password" name="pwd1" id="pwd" />
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
      echo '<span style="color:black; "><h2>ACCOUNT CREATED...</h2></span>';
   } else {
      echo   '<span style="color:black" style= "padding:1 100px"><h2>Try Again</h2></span>';
   }
   mysqli_close($link);
}
?>