<?php
extract($_REQUEST);
if (isset($logBtn)) {
    $link = mysqli_connect("localhost", "root", "", "quiz");
    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    $qry = "select email from regis where email='$umail' and password='$pass'";
    $r = mysqli_query($link, $qry);
    $c = mysqli_num_rows($r);
    if ($c == 1) {
        session_start();
        $_SESSION['email'] = $umail;
        header("Location:quiz_1.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script type="text/javascript">
    function f1() {
      var result = true;
      var a = document.frm1.umail.value;
      if (a == "") {
        document.getElementById('umailMsg').innerHTML = "Enter Email";
        console.log("document.getElementById('umail')", document.getElementById('umail'))
        result = false;
      } else {
        document.getElementById('umailMsg').innerHTML = "";
      }
      a = document.frm1.pass.value;
      if (a == "") {
        document.getElementById('passMSG').innerHTML = "Enter Password";
        console.log("document.getElementById('pass')", document.getElementById('pass'))
        result = false;
      } else {
        document.getElementById('passMSG').innerHTML = "";
      }
      return result;
    }
  </script>

 <style>
    body{
      background-image: url("https://t4.ftcdn.net/jpg/04/39/13/37/360_F_439133763_FrLdhZsd5aGC23r9ATARuKJBr8ifZjIe.jpg");
      background-repeat: no-repeat;
      /* background-position: center center; */
      background-size: cover;
      background-attachment: fixed;
    }
  </style>
 
</head>

<body>
  <div class = "main flex h-screen flex-col justify-center items-start pl-40 p-4">
    <form class = "form px-4 py-5 bg-[#e6e6e6] shadow-2xl rounded-md" align="center" name="frm1" onsubmit="return f1()">
      <div class="flex justify-center">
        <img class="w-[80px] h-[80px] rounded-full" src="https://t4.ftcdn.net/jpg/02/50/32/43/360_F_250324355_6nh8Q5iUdb499Q4v79hYMEcSlFpIBhn7.jpg">
      </div>
    <div class="heading p-2">
        <h1 class="text-[1.5rem] font-medium text-[#191c5c]"> Sign in to Quiz</h1>
        <!-- <hr class="border-t border-black border-2"></hr> -->
      </div>
      <div class="flex flex-col gap-3 p-2">
        <div class="flex flex-col pt-3">
          <label class="text-start text-sm font-medium text-[#191c5c]"> Username or email address : </label>
          <div style="display:flex; flex-direction:column;">
            <input class="px-4 py-2 text-[#191c5c] text-sm rounded-md focus:ring-0 outline-none border-1 border-gray-300" type="email" placeholder="Enter Your Email" name="umail" id="umail" />
            <span id="umailMsg" class="text-red-500  text-start text-xs"></span>
          </div>
        </div>
        <div class="flex flex-col">
          <label class="text-start text-sm font-medium text-[#191c5c]">Password :</label>
          <div style="display:flex; flex-direction:column;">
            <input class="px-4 py-2 rounded-md text-[#191c5c] text-sm focus:ring-0 outline-none border-1 border-gray-300" type="password" placeholder="Enter Password" name="pass" id="pass" />
            <span id="passMSG" class="text-red-500  text-start text-xs"></span>
          </div>
        </div>
      </div>
      <div class="p-2 pt-5">
        <input class="bg-[#191c5c] text-white cursor-pointer font-medium px-45 rounded-md py-2" type="submit" name="logBtn" value="Sign in">
        <p class="text-sm text-[#191c5c] p-3" > New to Quiz? <a href="regis.php" class="text-blue-600">Create an account</a></p>
      </div>
    </form>
  </div>
</body>

</html>
