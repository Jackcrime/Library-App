<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerdas Terpelajar Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        ::-webkit-scrollbar{
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
                <a href="#" class="hover:text-gray-300 transition">Home</a>
                <a href="#" class="hover:text-gray-300 transition">Books</a>
                <a href="#" class="hover:text-gray-300 transition">About Us</a>
                <a href="#" class="hover:text-gray-300 transition">Contact</a>
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 rounded-full text-white font-semibold shadow-md btn-hover">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-hero flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-6xl font-bold drop-shadow-lg">Welcome To Our Library</h1>
        <p class="text-lg mt-4 max-w-2xl">Jelajahi dunia buku tanpa batas! Daftar untuk menikmati akses penuh ke ribuan buku digital, tantangan membaca, dan diskusi interaktif.</p>
        <a href="{{ route('register') }}" class="mt-6 px-6 py-3 bg-gradient-to-r from-teal-400 to-blue-500 rounded-full shadow-lg font-semibold btn-hover">Get Started</a>
    </section>

    <!-- Feature Section -->
    <div class="bg-sky-900 py-2">
        <h1 class="text-4xl text-white font-bold text-center pt-10">Our Feature</h1>
        <div class="max-w-6xl mx-auto my-16 grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
            <div class="p-6 bg-white bg-opacity-90 rounded-lg shadow-lg text-center transform hover:scale-105 transition">
                <h2 class="text-2xl font-bold text-gray-800">📖 Digital Library</h2>
                <p class="mt-2 text-gray-600">Akses ribuan buku digital dari berbagai kategori.</p>
            </div>
            <div class="p-6 bg-white bg-opacity-90 rounded-lg shadow-lg text-center transform hover:scale-105 transition">
                <h2 class="text-2xl font-bold text-gray-800">🔍 Smart Search</h2>
                <p class="mt-2 text-gray-600">Cari buku favorit dengan mudah dan cepat.</p>
            </div>
            <div class="p-6 bg-white bg-opacity-90 rounded-lg shadow-lg text-center transform hover:scale-105 transition">
                <h2 class="text-2xl font-bold text-gray-800">🎯 Reading Challenges</h2>
                <p class="mt-2 text-gray-600">Ikuti tantangan membaca dan dapatkan reward.</p>
            </div>
        </div>
    </div>

    <!-- About Us Section -->
    <section class="bg-sky-700 text-white py-16 text-center flex items-center justify-center">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-left">
                <h1 class="text-4xl font-bold">About Us</h1>
                <p class="mt-4 max-w-3xl">Cerdas Terpelajar Library adalah perpustakaan digital yang didedikasikan untuk memberikan akses mudah ke sumber belajar terbaik bagi semua orang. Dengan berbagai koleksi buku dan fitur interaktif, kami membantu pengguna untuk terus berkembang.</p>
            </div>
            <div class="md:w-1/2 flex justify-center mt-6 md:mt-0">
                <img src="{{ asset('assets/nophoto.jpg') }}" alt="No Photo" class="w-64 h-64 object-cover rounded-lg shadow-lg">
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-sky-900 py-16">
        <div class="max-w-6xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold text-white">What Our Readers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <p class="text-gray-600 italic">"Platform ini sangat membantu saya menemukan buku favorit! Sungguh luar biasa."</p>
                    <h3 class="text-lg font-semibold mt-4">- Lisa, Student</h3>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <p class="text-gray-600 italic">"Tantangan membaca membuat saya lebih termotivasi. Terima kasih!"</p>
                    <h3 class="text-lg font-semibold mt-4">- Budi, Book Enthusiast</h3>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <p class="text-gray-600 italic">"Koleksi buku digitalnya sangat lengkap. Sangat direkomendasikan!"</p>
                    <h3 class="text-lg font-semibold mt-4">- Siti, Teacher</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="bg-gray-800 text-white py-16">
        <div class="max-w-6xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold">Contact Us</h2>
            <p class="mt-4 max-w-3xl mx-auto">Jika Anda memiliki pertanyaan atau ingin bekerja sama dengan kami, jangan ragu untuk menghubungi kami.</p>
            <form class="mt-8 max-w-3xl mx-auto">
                <input type="text" placeholder="Your Name" class="w-full p-3 rounded-md text-gray-800 mb-4">
                <input type="email" placeholder="Your Email" class="w-full p-3 rounded-md text-gray-800 mb-4">
                <textarea placeholder="Your Message" class="w-full p-3 rounded-md text-gray-800 mb-4" rows="5"></textarea>
                <button class="bg-teal-500 px-6 py-3 rounded-full shadow-lg font-semibold">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo dan Deskripsi -->
            <div class="space-y-4">
                <img src="{{ asset('assets/logo.png') }}" alt="logo e-perpus" class="w-28">
                <p class="text-gray-400">Sebuah perpustakaan online, tempat membaca dan tingkatkan pengetahuan!</p>
            </div>

            <!-- Kategori -->
            <div>
                <h2 class="text-lg font-semibold text-white mb-4">Kategori</h2>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Pemrograman</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Keuangan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Self Improvement</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Cerita Fiksi</a></li>
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
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-blue-400 transition">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 text-center text-gray-500 text-sm">
            &copy; 2024 Cerdas Terpelajar Library. All Rights Reserved.
        </div>
    </footer>
    <script>
        window.addEventListener("scroll", function() {
            var navbar = document.getElementById("navbar");
            var logo = document.getElementById("logo");

            if (window.scrollY > 50) {
                navbar.classList.add("bg-white", "text-black", "shadow-md");
                navbar.classList.remove("bg-transparent", "text-white");

                // Ganti logo saat scroll
                logo.src = "{{ asset('assets/logo-white.png') }}"; 
            } else {
                navbar.classList.add("bg-transparent", "text-white");
                navbar.classList.remove("bg-white", "text-black","shadow-md");

                // Kembalikan logo ke awal
                logo.src = "{{ asset('assets/logo.png') }}";
            }
        });
    </script>
</body>

</html>