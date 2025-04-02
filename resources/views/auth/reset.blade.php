<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            <h2 class="text-3xl font-extrabold text-blue-500 text-center" id="title">Reset Password</h2>
        </div>
        <p class="text-gray-300 text-center mt-2" id="subtitle">Enter your new password</p>

        @if (session('status'))
        <div class="text-center text-green-400 mt-4">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="text-center text-red-400 mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="mt-6 space-y-4" id="form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Address -->
            <div class="transition duration-300 transform hover:scale-105">
                <label class="block text-gray-200 mb-2 form-label">Email Address</label>
                <div class="relative">
                    <input type="email" name="email" class="w-full p-4 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="yourid@example.com">
                </div>
            </div>

            <!-- New Password -->
            <div class="transition duration-300 transform hover:scale-105">
                <label class="block text-gray-200 mb-2 form-label">New Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" class="w-full p-4 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="Enter new password">
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="transition duration-300 transform hover:scale-105">
                <label class="block text-gray-200 mb-2 form-label">Confirm Password</label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="w-full p-4 bg-gray-800 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input" required placeholder="Confirm new password">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-teal-500 text-white p-3 rounded-lg hover:opacity-90 transition duration-300 font-semibold text-lg">
                Reset Password
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Back to Login</a>
        </div>
    </div>

</body>
</html>
