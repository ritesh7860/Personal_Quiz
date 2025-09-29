<?php
include "welcome.php";
session_start();
if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

$link = new mysqli('localhost', 'root', '', 'quiz');
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$email = $_GET['email'] ?? '';
if (!$email) {
    die("Invalid request.");
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    if ($name && $role) {
        if ($password) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $link->prepare("UPDATE regis SET name=?, password=?, role=? WHERE email=?");
            $stmt->bind_param("ssss", $name, $hash, $role, $email);
        } else {
            $stmt = $link->prepare("UPDATE regis SET name=?, role=? WHERE email=?");
            $stmt->bind_param("sss", $name, $role, $email);
        }

        if ($stmt->execute()) {
            header("Location: admin_user.php");
            exit();
        } else {
            $msg = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $msg = "Name and role are required.";
    }
}

// fetch existing user data
$stmt = $link->prepare("SELECT name, email, role FROM regis WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <script type="text/javascript">
        function validateEmail(email) {
            const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return pattern.test(email);
        }

        function f() {
            var result = true;
            var a = document.frm.name.value;

            if (a === "") {
                document.getElementById('name').style.borderColor = 'red';
                result = false;
            } else {
                document.getElementById('name').style.borderColor = '';
            }

            // password is optional, no validation here unless you add strength checks
            return result;
        }

        function resetBorder(element) {
            element.style.borderColor = '';
        }

        function togglePassword() {
            const password = document.getElementById("pwd");
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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="main flex h-[80vh] mt-[50px] flex-col justify-center items-center">
        <?php if ($user): ?>
            <form class="form p-4 bg-white shadow-xl rounded-md" align="center" method="post" name="frm" onsubmit="return f()">
                <div class="heading p-2">
                    <h3 class="text-[1.5rem] font-medium text-[#191c5c]"> Edit User </h3>
                </div>

                <div class="flex flex-col gap-3 p-2">
                    <div class="flex flex-col pt-2">
                        <label class="text-start text-sm font-medium text-[#191c5c]">Username :</label>
                        <input class="px-4 py-2 text-[#191c5c] text-sm rounded-md focus:ring-1 outline-none border border-gray-300"
                            type="text" placeholder="Enter username" name="name" id="name"
                            value="<?= htmlspecialchars($user['name']) ?>" onfocus="resetBorder(this)" />
                    </div>

                    <div class="flex flex-col">
                        <label class="text-start text-sm font-medium text-[#191c5c]">Email : </label>
                        <input class="px-4 py-2 rounded-md text-[#191c5c] text-sm border border-gray-300 bg-gray-100 cursor-not-allowed"
                            type="text" value="<?= htmlspecialchars($user['email']) ?>" disabled />
                    </div>

                    <div class="flex flex-col relative">
                        <label class="text-start text-sm font-medium text-[#191c5c]">New Password (optional):</label>
                        <input class="px-4 py-2 rounded-md text-[#191c5c] text-sm focus:ring-1 outline-none border border-gray-300"
                            type="password" placeholder="Enter new password" name="password" id="pwd"
                            onfocus="resetBorder(this)" />

                        <!-- Eye Button -->
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-7 text-gray-500 hover:text-gray-700 cursor-pointer">
                            <!-- Eye Closed -->
                            <svg id="eyeClosed" class="hidden" width="18px" height="18px" viewBox="0 0 24 24" fill="none">
                                <path d="M12 16.01C14.2091 16.01 16 14.2191 16 12.01C16 9.80087 14.2091 8.01001 12 8.01001C9.79086 8.01001 8 9.80087 8 12.01C8 14.2191 9.79086 16.01 12 16.01Z"
                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M2 11.98C8.09 1.31996 15.91 1.32996 22 11.98"
                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M22 12.01C15.91 22.67 8.09 22.66 2 12.01"
                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <!-- Eye Open -->
                            <svg id="eyeOpen" width="18px" height="18px" viewBox="0 0 24 24" fill="none">
                                <path d="M14.83 9.17999C14.2706 8.61995 13.5576 8.23846 12.7813 8.08386C12.0049 7.92926 11.2002 8.00851 10.4689 8.31152C9.73758 8.61453 9.11264 9.12769 8.67316 9.78607C8.23367 10.4444 7.99938 11.2184 8 12.01C7.99916 13.0663 8.41619 14.08 9.16004 14.83"
                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 16.01C13.0609 16.01 14.0783 15.5886 14.8284 14.8384C15.5786 14.0883 16 13.0709 16 12.01"
                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M17.61 6.39004L6.38 17.62C4.6208 15.9966 3.14099 14.0944 2 11.99C6.71 3.76002 12.44 1.89004 17.61 6.39004Z"
                                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <div class="flex gap-4 py-4 items-center">
                            <label class="text-start text-sm font-medium text-[#191c5c]">Is Admin :</label>
                            <input type="radio" name="role" value="admin" <?= $user['role'] === 'admin' ? 'checked' : '' ?>> Yes
                            <input type="radio" name="role" value="user" <?= $user['role'] === 'user' ? 'checked' : '' ?>> No
                        </div>
                    </div>

                    <div>
                        <input class="bg-[#191c5c] text-white cursor-pointer font-medium px-30 rounded-md py-2 transition-all hover:scale-103 duration-500 hover:shadow-xl"
                            type="submit" name="btn" value="Save Changes" />
                    </div>
                    <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
                </div>
            </form>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
