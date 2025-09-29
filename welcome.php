<?php
session_start();
$adminName = isset($_SESSION['name']) ? $_SESSION['name'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Time</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');
    .logo {
      font-family: "Pacifico", cursive;
      /* font-family: "Allison", cursive; */
    }
    body{
        font-family: "Inter Tight", sans-serif;    
    }
  </style>

</head>

<body>

  <!-- Navbar -->
  <nav class="bg-[#191c5c] shadow-md fixed top-0 w-full h-[50px] min-h-[50px] z-10">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center min-h-[50px] h-[50px] ">
        <!-- Logo -->
        <div class="flex">
          <h1 class=" logo text-2xl font- tracking-wider italic text-white ">Quiz Time</h1>
          <!-- <img class="w-[50%] h-[50%] rounded-full" src="https://t4.ftcdn.net/jpg/02/50/32/43/360_F_250324355_6nh8Q5iUdb499Q4v79hYMEcSlFpIBhn7.jpg"> -->
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex md:gap-6 xl:gap-8 2xl:gap-10">
          <a href="admin_dashboard.php" class="text-gray-100 hover:text-[#191c5c] p-2 hover:bg-gray-300 rounded-sm font-semibold">Home</a>
          <a href="manage_questions.php" class="text-gray-100 hover:text-[#191c5c] p-2 hover:bg-gray-300 rounded-sm  font-semibold">Questions</a>
          <a href="admin_user.php" class="text-gray-100 hover:text-[#191c5c] p-2 hover:bg-gray-300 rounded-sm  font-semibold">Users</a>
          <a href="manage_technologies.php" class="text-gray-100 hover:text-[#191c5c] p-2 hover:bg-gray-300 rounded-sm font-semibold">Technologies</a>
          <a href="result.php" class="text-gray-100 hover:text-[#191c5c] p-2 hover:bg-gray-300 rounded-sm font-semibold">Results</a>

        </div>

        <div class="hidden md:flex items-center gap-4">
          <span class="text-gray-100 font-semibold">Welcome, <?= htmlspecialchars($adminName) ?> 👋</span>
          <a href="Logout.php" class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md text-sm font-semibold">Logout</a>
        </div>

        <!-- Mobile Hamburger -->
        <div class="md:hidden flex items-center">
          <button id="menu-btn" class="text-gray-100 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/1000/svg">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="menu" class="hidden md:hidden bg-[#191c5c] shadow-lg">
      <a href="insert.php" class="block px-4 py-2 text-gray-100 font-semibold">Home</a>
      <a href="manage_questions.php" class="block px-4 py-2 text-gray-100 font-semibold">Questions</a>
      <a href="admin_user.php" class="block px-4 py-2 text-gray-100 font-semibold">Users</a>
      <a href="manage_technologies.php" class="block px-4 py-2 text-gray-100 font-semibold">Technologies</a>
      <a href="result.php" class="block px-4 py-2 text-gray-100 font-semibold">Results</a>
      <a href="Logout.php" class="block px-4 py-2 text-gray-100 font-semibold">Logout</a>
    </div>
  </nav>

  <script>
    // Toggle Mobile Menu
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("menu");

    btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
    });
  </script>

</body>

</html>