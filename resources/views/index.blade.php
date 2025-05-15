<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Cerdas Terpelajar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Animasi transisi untuk tema */
        .transition-colors {
            transition: background-color 0.5s ease, color 0.5s ease;
        }
    </style>
</head>

<body x-data="{ darkMode: false }" :class="{'bg-gray-900 text-white transition-colors': darkMode, 'bg-gray-200 text-gray-800 transition-colors': !darkMode}" class="flex items-center justify-center min-h-screen">

    <!-- Container utama -->
    <div class="w-[90%] md:w-[75%] h-[90vh] shadow-lg rounded-xl overflow-hidden flex flex-col md:flex-row" :class="{'bg-gray-800 transition-colors': darkMode, 'bg-white transition-colors': !darkMode}">

        <!-- Bagian Kiri (Welcome Message) -->
        <div class="w-full md:w-1/2 p-12 flex flex-col justify-center text-center md:text-left">
            <div class="flex items-center text-sm mb-8">
                <img src="{{ asset('assets/Logo.png') }}" alt="Logo" class="w-10 h-10 mr-3 rounded-full">
                <span class="text-lg font-bold">Cerdas Terpelajar</span>
            </div>


            <h1 class="text-5xl font-extrabold mb-6">Selamat Datang!</h1>
            <p class="text-xl mt-2 leading-relaxed">
                Jadilah bagian dari revolusi pembelajaran modern! Temukan cara baru untuk belajar dengan lebih cerdas, lebih menyenangkan, dan lebih efektif!
            </p>


            <a class="mt-8 px-6 py-3 bg-teal-500 text-white text-lg rounded-lg shadow-lg 
        transition-all hover:bg-teal-600 hover:scale-110 active:scale-100 
        focus:ring focus:ring-teal-300 focus:outline-none hover:font-bold text-center"
                href="{{ url('/login') }}">
                <span>Mulai Sekarang</span>
            </a>


        </div>

        <!-- Bagian Kanan (Ilustrasi Full) -->
        <div class="w-full md:w-1/2 bg-cover bg-center hidden md:block" x-data="{ bg: '{{ asset('assets/Library.jpg') }}' }" :style="'background-image: url(' + bg + ');'"></div>

    </div>

    <!-- Tombol Toggle Tema -->
    <button @click="darkMode = !darkMode" class="fixed bottom-4 right-4 bg-gray-800 text-white rounded-full shadow-lg hover:bg-gray-700 transition p-1 w-6 h-6 flex items-center justify-center">
        <i :class="darkMode ? 'fas fa-sun text-xs' : 'fas fa-moon text-xs'"></i>
    </button>

</body>

</html>