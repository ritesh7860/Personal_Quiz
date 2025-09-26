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
  <title>WIN OR BOOZE</title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script type="text/javascript">

    function validateEmail(email) {
      // Simple email pattern
      const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
       return pattern.test(email);
    }

    function f1() {
      var result = true;
      var a = document.frm1.umail.value;
      const emailInput = document.getElementById('umail');
      const emailValue = emailInput.value.trim();

      if (a == "") {
        emailInput.style.borderColor = 'red';
        result = false;
      } else if (!validateEmail(emailValue)) {
          emailInput.style.borderColor = 'red';
          document.getElementById('emailMsg').innerText = "Please enter a valid email address.";
          result = false;
      }
      else {
        document.getElementById('umail').style.borderColor = '';
        emailMsg.innerText = "";
      }
      a = document.frm1.pass.value;
      if (a == "") {
        document.getElementById('pass').style.borderColor = 'red';
        result = false;
      } else {
        document.getElementById('pass').style.borderColor = '';
      }
      return result;
    }

    function resetBorder(element) {
         element.style.borderColor = '';
      }

      function togglePassword() {
         const password = document.getElementById("pass");
         const eyeOpen = document.getElementById("eyeOpen");
         const eyeClosed = document.getElementById("eyeClosed");

         if (password.type === "password") {
            password.type = "text";
            eyeOpen.classList.add("hidden");
            eyeClosed.classList.remove("hidden");
         } else {
            password.type = "password";
            eyeOpen.classList.remove("hidden");
            eyeClosed.classList.add("hidden");
         }
      }
  </script>

  <style>
    body {
      background-image: url("https://t4.ftcdn.net/jpg/04/39/13/37/360_F_439133763_FrLdhZsd5aGC23r9ATARuKJBr8ifZjIe.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
    }
  </style>

</head>

<body>
  <div class = "main flex h-screen flex-col justify-center items-start pl-36 p-4">
    <form class = "form px-4 py-5 bg-[#e6e6e6] shadow-2xl rounded-md" align="center" method="post" name="frm1" onsubmit="return f1()">
      <div class="flex justify-center">
        <img class="w-[80px] h-[80px] rounded-full" src="https://t4.ftcdn.net/jpg/02/50/32/43/360_F_250324355_6nh8Q5iUdb499Q4v79hYMEcSlFpIBhn7.jpg">
      </div>
      <div class="heading p-2">
        <h1 class="text-[1.5rem] font-medium text-[#191c5c]"> Sign in to Quiz</h1>
        <!-- <hr class="border-t border-black border-2"></hr> -->
      </div>

      <!-- Username or email address input Field -->

      <div class="flex flex-col gap-3 p-2">
        <div class="flex flex-col pt-3">
          <label class="text-start text-sm font-medium text-[#191c5c]"> Username or email address : </label>
          <div style="display:flex; flex-direction:column;">
            <input class="px-4 py-2 text-[#191c5c] text-sm rounded-md focus:ring-1 outline-none border-1 border-gray-300" placeholder="Enter your email" type="text" name="umail" id="umail" onfocus="resetBorder(this)" />
            <span id="emailMsg" class="text-red-700 text-xs text-start"></span>
          </div>
        </div>
        <div class="flex flex-col relative">
          <label class="text-start text-sm font-medium text-[#191c5c]">Password :</label>
          <div style="display:flex; flex-direction:column;">
            <input class="px-4 py-2 rounded-md text-[#191c5c] text-sm focus:ring-1 outline-none border-1 border-gray-300" type="password" placeholder="Enter your password" name="pass" id="pass" onfocus="resetBorder(this)" />
            <!-- Eye Button -->
               <button type="button" onclick="togglePassword()" class="absolute right-3 top-7 text-gray-500 hover:text-gray-700 cursor-pointer">
                  <!-- Eye Open -->
                  <svg id="eyeClosed" class="hidden" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M12 16.01C14.2091 16.01 16 14.2191 16 12.01C16 9.80087 14.2091 8.01001 12 8.01001C9.79086 8.01001 8 9.80087 8 12.01C8 14.2191 9.79086 16.01 12 16.01Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M2 11.98C8.09 1.31996 15.91 1.32996 22 11.98" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M22 12.01C15.91 22.67 8.09 22.66 2 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <!-- Eye Closed -->
                  <svg id="eyeOpen" width="18px" height="18px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M14.83 9.17999C14.2706 8.61995 13.5576 8.23846 12.7813 8.08386C12.0049 7.92926 11.2002 8.00851 10.4689 8.31152C9.73758 8.61453 9.11264 9.12769 8.67316 9.78607C8.23367 10.4444 7.99938 11.2184 8 12.01C7.99916 13.0663 8.41619 14.08 9.16004 14.83" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M12 16.01C13.0609 16.01 14.0783 15.5886 14.8284 14.8384C15.5786 14.0883 16 13.0709 16 12.01" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M17.61 6.39004L6.38 17.62C4.6208 15.9966 3.14099 14.0944 2 11.99C6.71 3.76002 12.44 1.89004 17.61 6.39004Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M20.9994 3L17.6094 6.39" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M6.38 17.62L3 21" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                     <path d="M19.5695 8.42999C20.4801 9.55186 21.2931 10.7496 21.9995 12.01C17.9995 19.01 13.2695 21.4 8.76953 19.23" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
               </button>
          </div>
        </div>
      </div>
      <!-- Sign In Button -->

      <div class="p-2 pt-5">
        <input class="bg-[#191c5c] text-white cursor-pointer font-medium px-35 rounded-md py-2 transition-all hover:scale-103 duration-500 hover:shadow-xl" type="submit" name="logBtn" value="Sign in">
        <p class="text-sm text-[#191c5c] p-3" > New to Quiz? <a href="Registration.php" class="text-blue-600">Create an account → </a></p>
      </div>
    </form>
  </div>
</body>

</html>