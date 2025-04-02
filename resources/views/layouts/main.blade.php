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

        .scrolled {
            background-color: rgba(0, 0, 0, 0.85);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Button Hover Effect */
        .btn-hover:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }

        ::-webkit-scrollbar {
            padding: 0px;
            margin: 0px;
        }
    </style>
</head>

<body class="relative">
    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full bg-transparent text-white py-4 transition-colors duration-300 z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div class="flex items-center">
                <img class="h-10 w-auto rounded-full" src="{{ asset('assets/Logo.png') }}" alt="Library Logo">
                <span class="ml-3 text-xl font-bold">Cerdas Terpelajar</span>
            </div>
            <div class="flex justify-center items-center space-x-6">
                <a href="{{ route('guest.dashboard') }}" class="hover:text-gray-300 transition">Home</a>
                <a href="{{ route('book') }}" class="hover:text-gray-300 transition">Books</a>
                <a href="{{ route('about') }}" class="hover:text-gray-300 transition">About Us</a>
                <a href="{{ route('contact') }}" class="hover:text-gray-300 transition">Contact</a>

                <!-- Dropdown Profile -->
                <div id="profileButton" x-data="{ open: false, showSettings: false, activeTab: 'general' }" class="relative">
                    <button @click="open = !open" @click.away="open = false"
                        class="flex items-center space-x-2 px-4 py-2 rounded-full hover:text-gray-500 transition">
                        <img class="w-8 h-8 rounded-full border-2 border-gray-500 object-cover"
                            src="{{ Auth::user()->foto ?: asset('assets/default.jpg') }}" alt="User  Profile">
                        <span class="hidden md:inline text-lg">{{ Auth::user()->nama}}</span>
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
                                <button @click="showSettings = true" class="flex items-center w-full text-left px-4 py-3 text-gray-700 hover:bg-gray-50 transition duration-200">
                                    <i class="fa-solid fa-cog mr-3"></i> Settings
                                </button>
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
                                    <!-- Progress Bar -->
                                    <div class="mb-4">
                                        <span class="block text-sm mb-1">Challenge Level</span>
                                        <div class="w-full bg-gray-700 rounded-full h-3">
                                            <div class="bg-blue-500 h-3 rounded-full" style="width: 75%;"></div>
                                        </div>
                                        <p class="text-gray-400 text-xs mt-1">Level 3 of 4</p>
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

    <main>
        @yield('contents')
    </main>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo dan Deskripsi -->
            <div class="space-y-4">
                <img src="{{ asset('assets/logo.png') }}" alt="logo e-perpus" class="w-28 rounded">
                <p class="text-gray-400">Sebuah perpustakaan online, tempat membaca dan tingkatkan pengetahuan!</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h2 class="text-lg font-semibold text-white mb-4">Quick Links</h2>
                <ul class="space-y-2">
                    <li><a href="{{ route('guest.dashboard') }}" class="text-gray-400 hover:text-blue-400 transition">Home</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Blog</a></li>
                    <li><a href="{{ route ('support') }}" class="text-gray-400 hover:text-blue-400 transition">Support</a></li>
                    <li><a href="{{ route ('privacy') }}" class ="text-gray-400 hover:text-blue-400 transition">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Sosial Media -->
            <div>
                <h2 class="text-lg font-semibold text-white mb-4">Sosial Media</h2>
                <div class="flex space-x-4">
                    <a href="#" class="text-black-400 hover:text-blue-400 transition">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="text-black-400 hover:text-blue-400 transition">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-black-400 hover:text-blue-400 transition">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-black-400 hover:text-blue-400 transition">
                        <i class="fab fa-youtube text-2xl"></i>
                    </a>
                </div>
            </div>

            <!-- Learn More -->
            <div>
                <h2 class="text-lg font-semibold text-white mb-4">Learn More</h2>
                <ul class="space-y-2">
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-blue-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-blue-400 transition">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 text-center text-gray-500 text-sm">
            &copy; 2024 Cerdas Terpelajar Library. All Rights Reserved.
        </div>
    </footer>
</body>

<script>
    window.addEventListener("scroll", function() {
        const navbar = document.getElementById("navbar");
        const profileButton = document.getElementById("profileButton");

        if (window.scrollY > 50) {
            navbar.classList.add("bg-white", "text-black", "shadow-md");
            navbar.classList.remove("bg-transparent", "text-white");
            profileButton.classList.add("text-black");
        } else {
            navbar.classList.add("bg-transparent", "text-white");
            navbar.classList.remove("bg-white", "text-black", "shadow-md");
            profileButton.classList.remove("text-black");
        }
    });

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