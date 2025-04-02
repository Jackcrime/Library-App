<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <style>
         .gradient-text {
            background: linear-gradient(to right, #2b7fff, #38b2ac); 
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-900 text-white p-6" id="body">

    <div class="bg-white bg-opacity-10 backdrop-blur-lg shadow-xl rounded-2xl overflow-hidden w-full max-w-5xl flex transition duration-300" id="container">

        <!-- Left Side: Login Form -->
        <div class="w-full md:w-1/2 p-10">
            <h2 class="text-4xl font-extrabold text-center text-blue-500 transition duration-300" id="title">CT Library</h2>
            <p class="text-gray-300 text-center mt-2 transition duration-300" id="subtitle">Sign in to explore a world of knowledge</p>

            <form action="{{ route('login') }}" method="POST" class="mt-6 space-y-4" id="form">
                @csrf

                <!-- Email Input -->
                <div>
                    <label class="block text-gray-200 mb-2 form-label">Email</label>
                    <div class="relative">
                        <input type="email" name="email" class="w-full p-4 pl-12 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="yourid@example.com">
                        <svg class="w-6 h-6 absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m8-8H8" />
                        </svg>
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label class="block text-gray-200 mb-2 form-label">Password</label>
                    <div class="relative">
                        <input id="password" type="password" name="password" class="w-full p-4 pl-12 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="Enter your password">
                        <svg id="togglePassword" class="w-6 h-6 absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3-6 10-6 10 6 10 6-3 6-10 6-10-6-10-6z" />
                        </svg>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex justify-between items-center text-gray-300" id="remember">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember Me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-blue-400 hover:underline">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-teal-500 text-white p-4 rounded-lg hover:opacity-90 transition duration-300 font-semibold text-lg">
                    Login
                </button>
            </form>

            <div class="flex justify-center items-center mt-4">
                <p class="mt-4 text-center text-gray-400">New to the library? <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Sign up</a></p>
                <button id="toggleTheme" class="ml-4 bg-gray-800 p-2 w-6 h-6 items-center justify-center flex mt-4 rounded-full hover:bg-gray-700 transition text-sm">
                    <i id="themeIcon" class="fas fa-moon text-white"></i>
                </button>
            </div>
        </div>

        <!-- Right Side: Library Illustration -->
        <div class="hidden md:block w-1/2 bg-cover bg-center img"></div>
    </div>

    <style>
        .img {
            background-image: url('{{ asset ("assets/bg.png") }}');
        }
    </style>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        });

        document.getElementById('toggleTheme').addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            document.getElementById('body').classList.toggle('bg-white');
            document.getElementById('body').classList.toggle('text-gray-900');
            document.getElementById('body').classList.toggle('bg-gray-900');
            document.getElementById('body').classList.toggle('text-white');
            document.getElementById('container').classList.toggle('bg-gray-100');
            document.getElementById('container').classList.toggle('bg-opacity-10');
            document.getElementById('subtitle').classList.toggle('text-gray-700');
            document.getElementById('subtitle').classList.toggle('text-gray-300');
            document.getElementById('remember').classList.toggle('text-gray-500');
            document.getElementById('remember').classList.toggle('text-gray-300');
            
            document.querySelectorAll('.form-label').forEach(label => {
                label.classList.toggle('text-gray-900');
                label.classList.toggle('text-gray-200');
            });

            const title = document.getElementById('title');
            if (document.documentElement.classList.contains('dark')) {
                title.classList.add('gradient-text');
                title.classList.remove('text-blue-500');
            } else {
                title.classList.remove('gradient-text');
                title.classList.add('text-blue-500');
            }

            document.querySelectorAll('.form-input').forEach(input => {
                input.classList.toggle('bg-gray-200');
                input.classList.toggle('bg-gray-800');
                input.classList.toggle('text-gray-900');
                input.classList.toggle('text-white');
                input.classList.toggle('focus:ring-yellow-600');
                input.classList.toggle('focus:ring-yellow-500');
            });

            const icon = document.getElementById('themeIcon');
            if (document.documentElement.classList.contains('dark')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
    </script>
</body>

</html>