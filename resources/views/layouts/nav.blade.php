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

        /* ::-webkit-scrollbar {
            padding: 0px;
            margin: 0px;
            display: hidden;
        } */
    </style>
</head>

<body x-data="{ open: false, showSettings: false, activeTab: 'general', theme: 'system' }" class="relative flex font-sans bg-gray-100 text-gray-900">

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-full w-64 bg-gray-900 text-white shadow-lg z-20">
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
                    <i class="fa-solid fa-arrow-right-arrow-left mr-3 text-purple-400"></i> Borrow
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
    <nav class="fixed top-0 left-64 w-[calc(100%-16rem)] bg-gray-800 shadow-md text-white py-4 z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <!-- Left Navigation Links -->
            <div class="flex items-center space-x-6 ml-auto">
                <a href="{{ route('guest.dashboard') }}" class="hover:text-gray-300 transition">Home</a>
                <a href="{{ route('book') }}" class="hover:text-gray-300 transition">Books</a>
                <a href="{{ route('about') }}" class="hover:text-gray-300 transition">About Us</a>
                <a href="{{ route('contact') }}" class="hover:text-gray-300 transition">Contact</a>


                <!-- Right Profile Dropdown -->
                <div class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center gap-3 px-4 py-2 rounded-full hover:bg-gray-700 transition">
                        <img class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover shadow"
                            src="{{ Auth::user()->foto ?: asset('assets/default.jpg') }}" alt="User Profile">
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-medium text-white">{{ Auth::user()->nama }}</p>
                            <p class="text-xs text-gray-200">Student</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-sm text-gray-400"></i>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-56 bg-gray-800 rounded-lg shadow-xl border border-gray-700 z-50">
                        <div class="px-4 py-3 bg-gray-900 rounded-t-lg">
                            <p class="text-white font-semibold">{{ Auth::user()->nama }}</p>
                            <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <ul class="py-2 divide-y divide-gray-700">
                            <li>
                                <a href="{{ route('profile') }}"
                                    class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 hover:text-white transition">
                                    <i class="fa-solid fa-user mr-3 text-blue-400"></i> Profile
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-3 text-red-400 hover:bg-gray-700 hover:text-red-300 transition">
                                        <i class="fa-solid fa-right-from-bracket mr-3"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

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
                                    <img class="w-12 h-12 rounded-full border-2 border-gray- 500 object-cover"
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
    <main class="ml-64 mt-16 w-full min-h-screen bg-white">
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
</script>

</html>