@extends('layouts.main')
@section('contents')

<style>
    .bg-hero {
        background-image: url('{{ asset("assets/background.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }

    .bg-hero::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .fade-in {
        animation: fadeIn 1.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<!-- Hero Section -->
<section class="relative py-20 text-center flex items-center justify-center min-h-screen text-white bg-hero">
    <div class="relative max-w-7xl mx-auto px-6 fade-in">
        <h1 class="text-5xl font-extrabold leading-tight">
            <span class="text-blue-400">Cerdas Terpelajar</span> Library
        </h1>
        <p class="text-lg max-w-3xl mx-auto mt-4">
            Perpustakaan digital yang memberikan akses mudah ke berbagai buku dari berbagai kategori.
            <span class="text-blue-300 font-semibold">Membaca adalah kunci</span> untuk meningkatkan wawasan dan keterampilan.
        </p>
        <a href="#" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-semibold shadow-md 
            hover:bg-blue-700 transition-all duration-300">Jelajahi Koleksi</a>
    </div>
</section>


<!-- Misi & Visi -->
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="p-8 bg-blue-50 shadow-lg rounded-lg hover:scale-105 transition-all duration-300 mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-semibold text-gray-900 mb-4">📕 Pendahuluan</h2>
            <p class="text-gray-700 text-lg">
                Perpustakaan Cerdas Terpelajar adalah platform peminjaman buku yang menyediakan akses
                mudah ke berbagai koleksi bacaan untuk mendukung pembelajaran, penelitian, dan pengembangan diri.
                Dengan teknologi inovatif, pengguna dapat dengan praktis mencari, meminjam, dan mengakses buku, jurnal, serta e-book berkualitas.
                Perpustakaan ini juga menawarkan lingkungan belajar yang nyaman dan fasilitas modern, bertujuan menjadi pusat literasi inklusif bagi semua kalangan.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="p-8 bg-green-50 shadow-lg rounded-lg hover:scale-105 transition-all duration-300" data-aos="fade-right" data-aos-duration="100">
                <h2 class="text-3xl font-semibold text-gray-900 mb-4">🚀 Visi Kami</h2>
                <p class="text-gray-700 text-lg">
                    Menjadi perpustakaan digital terdepan yang mendukung pembelajaran sepanjang hayat,
                    menciptakan ekosistem membaca yang mudah, inklusif, dan inovatif.
                </p>
            </div>
            <div class="p-8 bg-blue-50 shadow-lg rounded-lg hover:scale-105 transition-all duration-300" data-aos="fade-left">
                <h2 class="text-3xl font-semibold text-gray-900 mb-4">🎯 Misi Kami</h2>
                <p class="text-gray-700 text-lg">
                    Menyediakan sumber bacaan berkualitas yang dapat diakses oleh siapa saja, kapan saja.
                    Meningkatkan literasi dan pendidikan bagi masyarakat luas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Tim Kami -->
<section class="bg-gray-100 py-20 text-center">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">👨‍💻 Tim Kami</h2>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-8">
            Tim kami berdedikasi untuk memberikan pengalaman membaca terbaik, dengan latar belakang di bidang teknologi, pendidikan, dan literasi.
        </p>
        <div class="flex flex-wrap justify-center gap-8">
            <div class="bg-white p-6 shadow-lg rounded-lg hover:shadow-2xl transition-all duration-300 w-64" data-aos="fade-up">
                <img src="{{ asset('assets/default.jpg') }}" class="w-24 h-24 mx-auto rounded-full border-4 border-blue-300" alt="Tim">
                <h3 class="mt-4 text-xl font-semibold text-gray-900">King Abdiel</h3>
                <p class="text-gray-600 text-sm">CEO & Founder</p>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-lg hover:shadow-2xl transition-all duration-300 w-64" data-aos="fade-up" data-aos-delay="100">
                <img src="{{ asset('assets/default.jpg') }}" class="w-24 h-24 mx-auto rounded-full border-4 border-yellow-300" alt="Tim">
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Fernando Misha</h3>
                <p class="text-gray-600 text-sm">UX & UI Designer</p>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-lg hover:shadow-2xl transition-all duration-300 w-64" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/default.jpg') }}" class="w-24 h-24 mx-auto rounded-full border-4 border-green-300" alt="Tim">
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Edward Steven</h3>
                <p class="text-gray-600 text-sm">Front End Dev</p>
            </div>
            <div class="bg-white p-6 shadow-lg rounded-lg hover:shadow-2xl transition-all duration-300 w-64" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('assets/default.jpg') }}" class="w-24 h-24 mx-auto rounded-full border-4 border-red-300" alt="Tim">
                <h3 class="mt-4 text-xl font-semibold text-gray-900">Christ Diego</h3>
                <p class="text-gray-600 text-sm">Back End Dev</p>
            </div>
        </div>
    </div>
</section>

<!-- Hubungi Kami -->
<section class="bg-white py-20 text-center">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-semibold text-gray-900 mb-6">📩 Hubungi Kami</h2>
        <p class="text-lg text-gray-700 mb-4">Punya pertanyaan atau saran? Hubungi kami melalui media sosial kami!</p>
        <div class="flex justify-center space-x-6">
            <a href="#" class="text-gray-600 hover:text-blue-500 transition-all duration-300">
                <i class="fab fa-facebook text-3xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-blue-500 transition-all duration-300">
                <i class="fab fa-twitter text-3xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-blue-500 transition-all duration-300">
                <i class="fab fa-instagram text-3xl"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-blue-500 transition-all duration-300">
                <i class="fa-solid fa-envelope text-3xl"></i>
            </a>
        </div>
    </div>
</section>

<div class="flex justify-center my-10 px-4">
    <div class="overflow-hidden rounded-2xl shadow-lg transition-transform duration-300 transform w-full max-w-5xl" data-aos="fade-in">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.894996452182!2d115.17399807416992!3d-8.628949687710056!2m3!1f0!2f0!3f0!2m3!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd238cfa9704293%3A0xb90785bd6a37c482!2sSMK%20Wira%20Harapan!5e1!3m2!1sid!2sid!4v1741750661116!5m2!1sid!2sid"
            width="100%"
            height="450"
            style="border:0; border-radius: 16px;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
@endsection