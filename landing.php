<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Time - Test Your Coding Skills</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allison&family=Caveat:wght@400..700&family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Pacifico&display=swap');
    
        /* Base color */
        .primary-bg { background-color: #191c5c; }
        .primary-text { color: #191c5c; }
        .btn-primary { background-color: #191c5c; }
        .btn-primary:hover { background-color: #151a47; }

        .logo {
            font-family: "Pacifico", cursive;
            /* font-family: "Allison", cursive; */
        }

        /* Smooth transitions */
        .transition-all { transition: all 0.3s ease; }
        .icon-hover:hover {
            transform: rotate(360deg);
            transition: transform 0.5s ease-in-out;
        }
        .btn-hover:hover {
            transform: scale(1.05);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <header class="primary-bg text-white p-4 fixed w-full z-10 top-0 shadow-lg h-[10vh]">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class=" logo text-2xl font- tracking-wider italic text-white ">Quiz Time</div>
            <nav>
                <a href="#about" class="px-4 py-2 text-white hover:text-orange-500 transition-all">About</a>
                <a href="#features" class="px-4 py-2 text-white hover:text-orange-500 transition-all">Features</a>
                <a href="#testimonials" class="px-4 py-2 text-white hover:text-orange-500 transition-all">Testimonials</a>
                <a href="#leaderboard" class="px-4 py-2 text-white hover:text-orange-500 transition-all">Leaderboard</a>
                <a href="#quiz" class="px-4 py-2 btn-primary text-white rounded hover:bg-blue-600 transition-all">Start Quiz</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class=" flex flex-col md:flex-row primary-text bg-[#e6e6e6] text-center gap-6 mt-[10vh] h-[90vh] p-8" data-aos="fade-up">
        <div class="flex m-auto items-center flex-col w-full md:w-[50%]">
            <h1 class="text-5xl font-bold animate__animated animate__fadeIn animate__delay-1s">Test Your Coding Skills!</h1>
            <p class="mt-4 text-lg animate__animated animate__fadeIn animate__delay-2s">Challenge yourself with quizzes on HTML, Python, Java, and more. Learn as you go!</p>
            <a href="#quiz" class="mt-6 w-[60%] xl:w-[30%] font-semibold btn-primary text-white py-3 px-4 rounded btn-hover">Start Quiz Now</a>
        </div>
        <div class="m-auto w-full md:w-[50%]">
            <div>
                <img src="images/Login.png" alt="">
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 bg-gray-100 h-screen flex items-center" data-aos="fade-up">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-8">How It Works</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-12">
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition-all">
                    <h3 class="text-xl font-semibold">Step 1: Pick a Topic</h3>
                    <p class="mt-4">Choose your favorite technology from options like Java, Python, HTML, and more!</p>
                </div>
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition-all">
                    <h3 class="text-xl font-semibold">Step 2: Start the Quiz</h3>
                    <p class="mt-4">Answer multiple-choice questions, challenge yourself, and enhance your knowledge.</p>
                </div>
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition-all">
                    <h3 class="text-xl font-semibold">Step 3: See Your Score</h3>
                    <p class="mt-4">Get instant results, review the questions, and track your progress with every quiz!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quiz Categories Section -->
    <section id="quiz-categories" class="py-20" data-aos="fade-up">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-8">Explore Quiz Categories</h2>
            <p class="text-lg mb-12">Choose from a wide range of quiz topics to test your knowledge and improve your skills.</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8">
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition-all">
                    <h3 class="text-xl font-semibold">HTML</h3>
                    <p>Test your knowledge of HTML5, the foundation of web development.</p>
                </div>
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition-all">
                    <h3 class="text-xl font-semibold">Java</h3>
                    <p>Challenge yourself with advanced Java programming questions.</p>
                </div>
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition-all">
                    <h3 class="text-xl font-semibold">Python</h3>
                    <p>Explore the world of Python and improve your coding skills.</p>
                </div>
                <div class="p-6 bg-white rounded shadow-lg hover:shadow-xl transition-all">
                    <h3 class="text-xl font-semibold">React</h3>
                    <p>Test your knowledge of React.js, one of the most popular frameworks!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- User Testimonials Section -->
    <section id="testimonials" class="bg-gray-100 py-20" data-aos="fade-up">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-8">What Our Users Say</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-12">
                <div class="bg-white p-6 rounded shadow-lg transition-all">
                    <p class="text-lg mb-4">"I loved how interactive the quizzes were! I was able to test my skills and learn at the same time." - John D.</p>
                </div>
                <div class="bg-white p-6 rounded shadow-lg transition-all">
                    <p class="text-lg mb-4">"Great variety of topics! I improved my Python skills within just a week of using Quiz Time." - Sarah L.</p>
                </div>
                <div class="bg-white p-6 rounded shadow-lg transition-all">
                    <p class="text-lg mb-4">"As a beginner, the quizzes helped me solidify the basics of HTML and CSS. Highly recommend!" - Mark W.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Leaderboard Section -->
    <section id="leaderboard" class="py-20" data-aos="fade-up">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl font-semibold mb-8">Top Scorers</h2>
            <p class="text-lg mb-12">These are the top scorers who have excelled in our coding quizzes. Will you make it to the leaderboard?</p>
            <table class="mx-auto border-collapse table-auto w-full">
                <thead>
                    <tr class="bg-primary-bg text-white">
                        <th class="px-4 py-2">Rank</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">1</td>
                        <td class="px-4 py-2 text-center">Alice</td>
                        <td class="px-4 py-2 text-center">95%</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">2</td>
                        <td class="px-4 py-2 text-center">Bob</td>
                        <td class="px-4 py-2 text-center">92%</td>
                    </tr>
                    <tr class="border-b">
                        <td class="px-4 py-2 text-center">3</td>
                        <td class="px-4 py-2 text-center">Charlie</td>
                        <td class="px-4 py-2 text-center">90%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="cta" class="primary-bg text-white py-20" data-aos="fade-up">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-4xl font-semibold mb-8">Ready to Test Your Skills?</h2>
            <p class="text-lg mb-12">Join Quiz Time today and start improving your coding skills with fun and interactive quizzes.</p>
            <a href="#quiz" class="inline-block btn-primary text-white py-3 px-6 rounded btn-hover">Start Your First Quiz</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="primary-bg text-white py-8 text-center">
        <p>© 2025 Quiz Time | All rights reserved</p>
    </footer>

    <!-- Add FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- AOS Animation Library -->
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });
    </script>

</body>
</html>
