<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-[#191c5c] shadow-md fixed top-0 w-full h-[8vh] z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        
        <!-- Logo -->
        <div class="flex-shrink-0">
          <img class="w-[50px] h-[50px] rounded-full" src="https://t4.ftcdn.net/jpg/02/50/32/43/360_F_250324355_6nh8Q5iUdb499Q4v79hYMEcSlFpIBhn7.jpg">
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-8">
          <a href="#" class="text-gray-200 hover:text-blue-600 font-semibold">Home</a>
          <a href="#" class="text-gray-200 hover:text-blue-600 font-semibold">About</a>
          <a href="#" class="text-gray-200 hover:text-blue-600 font-semibold">Services</a>
          <a href="#" class="text-gray-200 hover:text-blue-600 font-semibold">Contact</a>
        </div>

        <!-- Mobile Hamburger -->
        <div class="md:hidden flex items-center">
          <button id="menu-btn" class="text-gray-200 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" 
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" 
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div id="menu" class="hidden md:hidden bg-[#191c5c] shadow-lg">
      <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-100 font-semibold">Home</a>
      <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-100 font-semibold">About</a>
      <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-100 font-semibold">Services</a>
      <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-100 font-semibold">Contact</a>
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
