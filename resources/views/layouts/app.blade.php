<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            padding: 0px;
            margin: 0px;
            height: 100vh;
            display: flex;
        }

        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-item.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        footer {
            margin-top: auto;
        }

        @keyframes bounce {
            0%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-6px);
            }
        }

        .dot {
            display: inline-block;
            animation: bounce 1.4s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        .dot:nth-child(4) {
            animation-delay: 0.6s;
        }

        @keyframes fadeScaleIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
        @keyframes spin-slow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .animate-rotate {
            animation: spin-slow 2s linear infinite;
        }

        .animate-fade-in {
            animation: fadeScaleIn 0.5s ease-out forwards;
        }

        .animate-fade-out {
         animation: fadeOut 0.5s ease-out forwards;
        }
        
    </style>
</head>

<body x-data="{ sidebarOpen: true }" class="bg-gray-100 flex">
    <!-- Splash Screen -->
    <div id="splashScreen" class="fixed inset-0 z-50 flex items-center justify-center bg-white animate-fade-in">
        <div class="text-center space-y-4">
            <!-- Icon di tengah -->
            <div class="flex justify-center">
                <i class="fas fa-cog text-gray-800 text-5xl animate-spin"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-700">Admin Page</h1>
            <p class="text-gray-500 text-lg flex items-center justify-center gap-1">
                Loading<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>
            </p>
        </div>
    </div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-0'" class="bg-gray-900 text-white h-screen fixed top-0 left-0 shadow-lg transition-all duration-300 overflow-hidden">
        <nav class="mt-20">
            <ul>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i data-lucide="home"></i>
                    <a href="{{ route('admin.dashboard') }}" class="block">Dashboard</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i data-lucide="users"></i>
                    <a href="{{ route('users.index') }}" class="block">Manage Users</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/books*') ? 'active' : '' }}">
                    <i data-lucide="book"></i>
                    <a href="{{ route('bukus.index') }}" class="block">Manage Books</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i data-lucide="layers"></i>
                    <a href="{{ route('kategoris.index') }}" class="block">Manage Categories</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/borrows*') ? 'active' : '' }}">
                    <i data-lucide="bookmark"></i>
                    <a href="{{ route('pinjams.index') }}" class="block">Manage Borrows</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/returns*') ? 'active' : '' }}">
                    <i data-lucide="refresh-ccw"></i>
                    <a href="{{ route('pengembalians.index') }}" class="block">Manage Returns</a>
                </li>
            </ul>
        </nav>
        <div class="absolute bottom-4 left-4 text-gray-400">
            <span>Login as: <br> <strong>Admin {{ Auth::user()->nama }}</strong></span>
        </div>
    </aside>
    <!-- end sidebar -->

    <!-- Start Navbar -->
    <div :class="sidebarOpen ? 'ml-64' : 'ml-0'" class="flex-1 transition-all duration-300">
        <nav class="bg-gray-900 text-white shadow-md p-4 flex justify-between items-center fixed top-0 left-0 right-0 z-10">
            <div class="flex items-center">
                <div class="flex items-center">
                    <i data-lucide="settings" class="text-white"></i>
                    <span class="ml-2 text-white font-bold">Admin Panel</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" aria-expanded="sidebarOpen" class="text-white ml-4">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
            <div class="flex items-center">
                <h1 class="mr-4 text-gray-400 font-sans">Perpustakaan 1.0 Beta</h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
                        <i data-lucide="log-out"></i>
                    </button>
                </form>
            </div>
        </nav>

        <main class="p-4 flex-1 transition-all duration-300 pt-16 pb-16">
            @yield ('content')
        </main>

        <footer class="py-4 bg-gray-200">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <div>&copy; <span id="current-year"></span> Admin Panel</div>
                    <div>
                        <a href="#" class="text-gray-600 hover:text-gray-800">Privacy Policy</a>
                        <span class="mx-2">·</span>
                        <a href="#" class="text-gray-600 hover:text-gray-800">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end Navbar -->

    <script>
        // Set current year in footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
        
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
        lucide.createIcons();

        window.addEventListener("DOMContentLoaded", () => {
        const splash = document.getElementById("splashScreen");
        setTimeout(() => {
            splash.classList.remove("animate-fade-in");
            splash.classList.add("animate-fade-out");
            setTimeout(() => splash.remove(), 2000);
        }, 2000);
    });
    </script>
</body>

</html>