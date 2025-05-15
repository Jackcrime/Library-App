<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerdas Terpelajar Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        .animate-fade-in {
            animation: fadeScaleIn 0.5s ease-out forwards;
        }

        .animate-fade-out {
            animation: fadeOut 0.5s ease-out forwards;
        }
        
    </style>
</head>

<body x-data="{ showSettings: false, activeTab: 'general', theme: 'system', sidebarOpen: true }" class="relative flex font-sans bg-gray-100 text-gray-900">
    <!-- Splash Screen -->
    <div id="splashScreen" class="fixed inset-0 z-50 flex items-center justify-center bg-white animate-fade-in">
        <div class="text-center space-y-6">
        <div class="flex justify-center">
            <img src="{{ asset('assets/book_open.gif') }}"
                 alt="Library Logo"
                 class="w-28 h-28 sm:w-32 sm:h-32 mx-auto transition duration-500">
        </div>

        <!-- Title -->
        <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 tracking-wide">
            Library Menu
        </h1>

        <!-- Loading Text -->
        <div class="flex items-center justify-center text-lg text-gray-600 font-medium space-x-1">
            <span>Loading</span>
            <span class="dot">.</span>
            <span class="dot">.</span>
            <span class="dot">.</span>
        </div>
        </div>
    </div>
    <!-- Sidebar -->
    <aside x-show="sidebarOpen"
        @click.away="sidebarOpen = false"
        class="fixed top-0 left-0 h-full w-64 bg-gray-900 text-white shadow-lg z-32 transition-all"
        x-transition>
        <div class="p-6">
            <h2 class="text-2xl font-extrabold mb-8 flex items-center gap-2">
                <i class="fa-solid fa-book"></i> Library Menu
            </h2>
            <nav class="space-y-3">
                <a href="{{ route('book') }}"
                    class="flex items-center px-4 py-3 hover:bg-gray-800 rounded-lg transition duration-200">
                    <i class="fa-solid fa-compass mr-3 text-teal-400"></i> Discover (Main)
                </a>
                <a href="{{ route('book.favorite') }}"
                    class="flex items-center px-4 py-3 hover:bg-gray-800 rounded-lg transition duration-200">
                    <i class="fa-solid fa-heart mr-3 text-red-300"></i> Favorites
                </a>
                <a href="{{ route('book.bookmark') }}"
                    class="flex items-center px-4 py-3 hover:bg-gray-800 rounded-lg transition duration-200">
                    <i class="fa-solid fa-book mr-3 text-blue-400"></i> My Library
                </a>
                <a href="{{ route('book.history') }}"
                    class="flex items-center px-4 py-3 hover:bg-gray-800 rounded-lg transition duration-200">
                    <i class="fa-solid fa-history mr-3 text-purple-400"></i> History Borrow
                </a>

                <hr class="border-gray-700 my-4">

                <button @click="showSettings = true" class="flex w-full text-left items-center px-4 py-3 hover:bg-gray-800 rounded-lg transition duration-200">
                    <i class="fa-solid fa-cog mr-3"></i> Settings
                </button>

                <a href="{{ route ('support') }}" class="flex items-center px-4 py-3 hover:bg-gray-800 rounded-lg transition duration-200">
                    <i class="fa-solid fa-circle-question mr-3 "></i> Support
                </a>
                <form action="{{ route('logout') }}" method="POST" class="pt-2">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full text-left px-4 py-3 text-red-400 hover:bg-red-900/30 rounded-lg transition duration-200">
                        <i class="fa-solid fa-right-from-bracket mr-3"></i> Logout
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Top Navbar -->
    <nav :class="sidebarOpen ? 'left-64 w-[calc(100%-16rem)]' : 'left-0 w-full'"
        class="fixed top-0 bg-gray-800 shadow-md text-white py-4 transition-all duration-300 z-20">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <!-- Toggle Sidebar -->
            <button @click="sidebarOpen = !sidebarOpen" class="text-white mr-4">
                <i :class="sidebarOpen ? 'fa-solid fa-times' : 'fa-solid fa-bars'" class="text-2xl"></i>
            </button>
            <!-- Right Navigation Links -->
            <div class="flex items-center space-x-6 ml-auto">
                <a href="{{ route('guest.dashboard') }}" class="hover:text-gray-300 transition">Home</a>
                <a href="{{ route('book') }}" class="hover:text-gray-300 transition">Books</a>
                <a href="{{ route('about') }}" class="hover:text-gray-300 transition">About Us</a>
                <a href="{{ route('contact') }}" class="hover:text-gray-300 transition">Contact</a>
                <div class="relative">
                    <a href="{{ route('profile') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-700 transition">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover shadow"
                            src="{{ Auth::user()->foto ?: asset('assets/default.jpg') }}" alt="User  Profile">
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->nama }}</p>
                            <p class="text-xs text-gray-200">Student</p>
                        </div>
                    </a>

                    <!-- Modal Settings -->
                    <div x-show="showSettings"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">

                        <div class="bg-gray-900 text-white rounded-lg shadow-lg w-[700px] max-w-full flex relative">
                            <!-- Sidebar -->
                            <div class="w-1/3 bg-gray-800 p-5 rounded-l-lg">
                                <h2 class="text-lg font-semibold mb-4">Settings</h2>
                                <ul class="space-y-2">
                                    <li>
                                        <button @click="activeTab = 'general'" class="flex items-center w-full p-2 rounded-md hover:bg-gray-700" :class="{'bg-gray-700': activeTab === 'general'}">
                                            <i class="fa-solid fa-gear mr-2"></i> General
                                        </button>
                                    </li>
                                    <li>
                                        <button @click="activeTab = 'appearance'" class="flex items-center w-full p-2 rounded-md hover:bg-gray-700" :class="{'bg-gray-700': activeTab === 'appearance'}">
                                            <i class="fa-solid fa-palette mr-2"></i> Appearance
                                        </button>
                                    </li>
                                    <li>
                                        <button @click="activeTab = 'security'" class="flex items-center w-full p-2 rounded-md hover:bg-gray-700" :class="{'bg-gray-700': activeTab === 'security'}">
                                            <i class="fa-solid fa-shield-alt mr-2"></i> Security
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <!-- Content -->
                            <div class="w-2/3 p-6">
                                <button @click="showSettings = false" class="absolute top-3 right-3 text-gray-400 hover:text-gray-200">
                                    <i class="fa-solid fa-times text-lg"></i>
                                </button>

                                <!-- User Info -->
                                <div class="flex items-center space-x-3 mb-4">
                                    <img class="w-12 h-12 rounded-full border-2 border-gray-500 object-cover"
                                        src="{{ Auth::user()->foto ?: asset('assets/default.jpg') }}" alt="User  Profile">
                                    <div>
                                        <h3 class="text-lg font-semibold">Student {{ Auth::user()->nama }}</h3>
                                        <p class="text-gray-400 text-sm">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>

                                <!-- General Settings -->
                                <div x-show="activeTab === 'general'">
                                    <h3 class="text-lg font-semibold mb-4">General Settings</h3>
                                    <div class="flex justify-between items-center mb-4">
                                        <span>Theme</span>
                                        <select x-model="theme" class="bg-gray-800 text-white p-2 rounded-md">
                                            <option value="system">System</option>
                                            <option value="light">Light</option>
                                            <option value="dark">Dark</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Appearance Settings -->
                                <div x-show="activeTab === 'appearance'" style="display: none;">
                                    <h3 class="text-lg font-semibold mb-4">Appearance Settings</h3>
                                    <div class="flex items-center mb-4">
                                        <span class="mr-4">Font Size</span>
                                        <select x-model="fontSize" class="bg-gray-800 text-white p-2 rounded-md">
                                            <option value="small">Small</option>
                                            <option value="medium">Medium</option>
                                            <option value="large">Large</option>
                                        </select>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <span class="mr-4">Color Scheme</span>
                                        <select x-model="colorScheme" class="bg-gray-800 text-white p-2 rounded-md">
                                            <option value="default">Default</option>
                                            <option value="high-contrast">High Contrast</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Security Settings -->
                                <div x-show="activeTab === 'security'" style="display: none;">
                                    <h3 class="text-lg font-semibold mb-4">Security Settings</h3>
                                    <div class="flex items-center mb-4">
                                        <span class="mr-4">Two-Factor Authentication</span>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" x-model="twoFactorAuth" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-600 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer-checked:bg-blue-500"></div>
                                        </label>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-sm">Enable two-factor authentication for added security.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main :class="sidebarOpen ? 'ml-64' : 'ml-0'"
        class="mt-16 w-full min-h-screen bg-white transition-all duration-300">
        @yield('contents')

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-10 mt-10 shadow-inner">
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

    window.addEventListener("DOMContentLoaded", () => {
        const splash = document.getElementById("splashScreen");
        setTimeout(() => {
            splash.classList.remove("animate-fade-in");
            splash.classList.add("animate-fade-out");
            setTimeout(() => splash.remove(), 2000);
        }, 2000);
    });
</script>

</html>