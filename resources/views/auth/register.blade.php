<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Register</title>
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

<body class="flex items-center justify-center min-h-screen bg-gray-900 text-white p-6 transition duration-500" id="body">

    <div class="bg-white bg-opacity-10 backdrop-blur-lg shadow-xl rounded-2xl overflow-hidden w-full max-w-md p-10 transition duration-500" id="container">
        <div class="flex justify-center items-center mb-4">
            <h2 class="text-4xl font-extrabold text-blue-500 text-center" id="title">CT Library</h2>
        </div>
        <p class="text-gray-300 text-center mt-2" id="subtitle">Sign up to access a world of books</p>

        <form action="{{ route('register.post') }}" method="POST" class="mt-6 space-y-4" id="form">
            @csrf

            <!-- Full Name -->
            <div class="transition duration-300 transform hover:scale-105">
                <label class="block text-gray-200 mb-2 form-label">Full Name</label>
                <div class="relative">
                    <input type="text" name="nama" class="w-full p-4 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="Enter your full name">
                </div>
            </div>

            <!-- Email Address -->
            <div class="transition duration-300 transform hover:scale-105">
                <label class="block text-gray-200 mb-2 form-label">Email Address</label>
                <div class="relative">
                    <input type="email" name="email" class="w-full p-4 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="yourid@example.com">
                </div>
            </div>

            <!-- Password -->
            <div class="transition duration-300 transform hover:scale-105">
                <label class="block text-gray-200 mb-2 form-label">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" class="w-full p-4 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="Enter your password">
                    <svg id="togglePassword" class="w-6 h-6 absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" onclick="togglePasswordVisibility('password', this)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3-6 10-6 10 6 10 6-3 6-10 6-10-6-10-6z" />
                    </svg>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="transition duration-300 transform hover:scale-105">
                <label class="block text-gray-200 mb-2 form-label">Confirm Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-4 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="Confirm your password">
                    <svg id="togglePasswordConfirmation" class="w-6 h-6 absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" onclick="togglePasswordVisibility('password_confirmation', this)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12s3-6 10-6 10 6 10 6-3 6-10 6-10-6-10-6z" />
                    </svg>
                </div>
            </div>

            <!-- Register Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-teal-500 text-white p-3 rounded-lg hover:opacity-90 transition duration-300 font-semibold text-lg">
                Register
            </button>
        </form>

        <div class="flex justify-center items-center mt-4">
            <p class="text-gray-400 text-sm">Already have an account? <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Sign in</a></p>
            <button id="toggleTheme" class="ml-4 bg-gray-800 p-2 w-6 h-6 items-center justify-center flex rounded-full hover:bg-gray-700 transition text-sm">
                <i id="themeIcon" class="fas fa-moon text-white"></i>
            </button>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, icon) {
            const passwordField = document.getElementById(inputId);
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

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
            document.getElementById('toggleTheme').classList.toggle('text-gray-200');
            document.getElementById('toggleTheme').classList.toggle('text-gray-700');

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