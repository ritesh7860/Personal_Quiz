<?php
declare(strict_types=1);
session_start();

// Server-side login handling (all PHP in one place, at top)
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use explicit $_POST (don't use extract())
    $umail = trim((string)($_POST['umail'] ?? ''));
    $pass  = (string)($_POST['pass'] ?? '');

    if ($umail === '' || $pass === '') {
        $errorMsg = 'Email and password are required.';
    } else {
        // Connect DB
        $link = new mysqli('localhost', 'root', '', 'quiz');
        if ($link->connect_error) {
            $errorMsg = 'Database connection failed: ' . $link->connect_error;
        } else {
            // Prepared statement: fetch stored password for the email
            $stmt = $link->prepare('SELECT email, password FROM regis WHERE email = ? LIMIT 1');
            $stmt->bind_param('s', $umail);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                $stored = (string)$row['password'];

                // If passwords in DB are hashed use password_verify,
                // otherwise (temporary) compare plaintext safely with hash_equals.
                $isHashed = password_get_info($stored)['algo'] !== 0;
                $ok = $isHashed ? password_verify($pass, $stored) : hash_equals($stored, $pass);

                if ($ok) {
                    session_regenerate_id(true);
                    $_SESSION['email'] = $umail;
                    // Redirect to quiz page
                    header('Location: quiz_1.php');
                    exit();
                } else {
                    $errorMsg = 'Invalid email or password.';
                }
            } else {
                $errorMsg = 'Invalid email or password.';
            }

            $stmt->close();
            $link->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>WIN OR BOOZE - Login</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background-image: url("https://t4.ftcdn.net/jpg/04/39/13/37/360_F_439133763_FrLdhZsd5aGC23r9ATARuKJBr8ifZjIe.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
    }
    /* small inline tweak so the eye icon sits inside input */
    .input-wrap { position: relative; }
    .input-wrap .fa-eye, .input-wrap .fa-eye-slash {
      position: absolute;
      right: 12px;
      top: 72%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #6b7280;
    }
  </style>

  <script type="text/javascript">
//    Client-side validation (keeps your existing behaviour)
    function f1() {
      var result = true;
      var email = document.frm1.umail.value.trim();
      if (email == "") {
        document.getElementById('umailMsg').innerHTML = "Enter Email";
        result = false;
      } else {
        document.getElementById('umailMsg').innerHTML = "";
      }
      var pass = document.frm1.pass.value;
      if (pass == "") {
        document.getElementById('passMSG').innerHTML = "Enter Password";
        result = false;
      } else {
        document.getElementById('passMSG').innerHTML = "";
      }
      return result;
    }

    // Password visibility toggle
    function togglePassword() {
      var p = document.getElementById('pass');
      var icon = document.getElementById('eyeIcon');
      if (p.type === 'password') {
        p.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        p.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
</head>
<body>
  <div class="main flex h-screen flex-col justify-center items-start pl-40 p-4">
    <form class="form px-4 py-5 bg-[#e6e6e6] shadow-2xl rounded-md" method="post" align="center" name="frm1" onsubmit="return f1()">
      <div class="flex justify-center mb-4">
        <img class="w-[80px] h-[80px] rounded-full" src="https://t4.ftcdn.net/jpg/02/50/32/43/360_F_250324355_6nh8Q5iUdb499Q4v79hYMEcSlFpIBhn7.jpg" alt="logo">
      </div>
      <div class="heading p-2">
        <h1 class="text-[1.5rem] font-medium text-[#191c5c] text-center">Sign in to Quiz</h1>
      </div>

      <!-- Email Field -->
      <div class="flex flex-col pt-3">
        <label class="text-start text-sm font-medium text-[#191c5c]">Username or email address:</label>
        <input class="px-4 py-2 text-[#191c5c] text-sm rounded-md focus:ring-0 outline-none border border-gray-300"
               type="email" placeholder="Enter Your Email" name="umail" id="umail"/>
        <span id="umailMsg" class="text-red-500 text-start text-xs"></span>
      </div>

      <!-- Password Field with Eye -->
      <div class="flex flex-col pt-3 input-wrap">
        <label class="text-start text-sm font-medium text-[#191c5c]">Password :</label>
        <input class="px-4 py-2 rounded-md text-[#191c5c] text-sm focus:ring-0 outline-none border border-gray-300 w-full"
               type="password" placeholder="Enter Password" name="pass" id="pass" />
        <i id="eyeIcon" class="fa fa-eye" onclick="togglePassword()" aria-hidden="true"></i>
        <span id="passMSG" class="text-red-500 text-start text-xs"></span>
      </div>

      <!-- Server-side error message -->
      <?php if ($errorMsg !== ''): ?>
        <p class="text-red-600 text-sm mt-2"><?= htmlspecialchars($errorMsg, ENT_QUOTES, 'UTF-8') ?></p>
      <?php endif; ?>

<!-- Sign In Button -->

      <div class="p-2 pt-5">
        <input class="bg-[#191c5c] text-white cursor-pointer font-medium px-45 rounded-md py-2" type="submit" name="logBtn" value="Sign in">
        <p class="text-sm text-[#191c5c] p-3"> New to Quiz? <a href="regis.php" class="text-blue-600">Create an account</a></p>
      </div>
    </form>
  </div>
</body>
</html>
