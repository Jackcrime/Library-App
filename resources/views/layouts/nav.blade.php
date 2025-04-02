<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerdas Terpelajar Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        /* Background Styling */
        .bg-hero {
            background: url('{{ asset("assets/background.jpg") }}') center/cover no-repeat;
            height: 100vh;
            background-attachment: fixed;
        }

        /* Navbar Styling */
        .navbar {
            transition: background-color 0.3s;
        }

        /* Button Hover Effect */
        .btn-hover:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        /* ::-webkit-scrollbar {
            padding: 0px;
            margin: 0px;
            display: hidden;
        } */
    </style>
</head>

<body class="relative flex">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-full w-64 bg-gray-800 text-white p-5 z-10">
        <h2 class="text-xl font-bold mb-6">📖 Library Menu</h2>
        <nav class="space-y-2">
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fa-solid fa-book-open mr-3"></i> Discover (Main)
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fa-solid fa-star mr-3"></i> Fav
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fa-solid fa-book mr-3"></i> My Library
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fa-solid fa-arrow-right-arrow-left mr-3"></i> Borrow
            </a>
            <hr class="border-gray-700 my-2">
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fa-solid fa-cog mr-3"></i> Settings
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fa-solid fa-circle-question mr-3"></i> Support
            </a>
            <a href="#" class="flex items-center px-4 py-2 hover:bg-red-600 rounded">
                <i class="fa-solid fa-right-from-bracket mr-3"></i> Logout
            </a>
        </nav>
    </aside>

    <!-- Navbar (Hanya Profil) -->
    <nav class="fixed top-0 left-64 w-[calc(100%-16rem)] bg-gray-800 text-white py-4 z-10">
        <div class="max-w-7xl mx-auto flex justify-end items-center px-6">
            <!-- Dropdown Profile -->
            <div id="profileButton" x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.away="open = false"
                    class="flex items-center space-x-2 px-4 py-2 rounded-full hover:text-gray-500 transition">
                    <img class="w-8 h-8 rounded-full border-2 border-gray-500 object-cover"
                        src="{{ Auth::user()->foto ?: asset('assets/default.jpg') }}" alt="User Profile">
                    <span class="hidden md:inline text-lg">{{ Auth::user()->nama }}</span>
                    <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-transition
                    class="absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg border border-gray-200">
                    <div class="px-4 py-3 bg-gray-100">
                        <p class="text-gray-800 font-semibold">Student {{ Auth::user()->nama }}</p>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Menu Items -->
                    <ul class="py-2 bg-white shadow-lg rounded-lg w-48 divide-y divide-gray-200">
                        <li>
                            <a href="{{ route('profile') }}" class="flex items-center w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition duration-200">
                                <i class="fa-solid fa-user text-blue-500 mr-3"></i> Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition duration-200">
                                    <i class="fa-solid fa-right-from-bracket text-red-500 mr-3"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="ml-64 mt-16 w-full">
        @yield('contents')

        <footer class="bg-gray-900 text-white py-10">
            <div class="container mx-auto text-center">
                <p class="text-gray-400 text-sm">
                    &copy; 2024 Cerdas Terpelajar Library. All Rights Reserved.
                </p>
            </div>
        </footer>
    </main>
</body>

<script>
    function checkSession() {
        fetch('/check-session')
            .then(response => response.json())
            .then(data => {
                if (!data.logged_in) {
                    alert("Session expired. Redirecting to login page.");
                    window.location.href = "/login";
                }
            })
            .catch(error => console.error('Error checking session:', error));
    }
    setInterval(checkSession, 30000);
</script>

</html>