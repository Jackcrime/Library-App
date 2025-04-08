@extends('layouts.main')
@section('contents')

<!-- Hero Section -->
<section class="bg-hero flex flex-col items-center justify-center text-center text-white px-6">
    <h1 class="text-6xl font-bold drop-shadow-lg">Welcome To Our Library</h1>
    <p class="text-lg mt-4 max-w-2xl">Jelajahi dunia buku tanpa batas! Daftar untuk menikmati akses penuh ke ribuan buku digital, tantangan membaca, dan diskusi interaktif.</p>
</section>

<!-- Feature Section -->
<div class="bg-sky-900 py-2">
    <h1 class="text-4xl text-white font-bold text-center pt-10">Our Feature</h1>
    <div class="max-w-6xl mx-auto my-16 grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
        <div class="p-6 bg-white bg-opacity-90 rounded-lg shadow-lg text-center transform hover:scale-105 transition">
            <h2 class="text-2xl font-bold text-gray-800">📖 Digital Books</h2>
            <p class="mt-2 text-gray-600">Menampilkan daftar buku digital yang bisa dibaca langsung.</p>
        </div>
        <div class="p-6 bg-white bg-opacity-90 rounded-lg shadow-lg text-center transform hover:scale-105 transition">
            <h2 class="text-2xl font-bold text-gray-800">🔖 Bookmark</h2>
            <p class="mt-2 text-gray-600">Menyimpan buku yang ingin dibaca nanti.</p>
        </div>
        <div class="p-6 bg-white bg-opacity-90 rounded-lg shadow-lg text-center transform hover:scale-105 transition">
            <h2 class="text-2xl font-bold text-gray-800">📚 Borrow</h2>
            <p class="mt-2 text-gray-600">Meminjam buku fisik jika tersedia.</p>
        </div>
    </div>
</div>

<!-- News Section -->
<section class="bg-sky-700 text-white py-12 text-center">
    <h2 class="text-3xl font-bold">📢 News & Updates</h2>
    <p class="mt-2 text-sm">Berita terbaru seputar dunia literasi dan buku populer.</p>

    <!-- Swiper Container -->
    <div class="swiper mySwiper max-w-2xl mx-auto mt-6">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <a href="/news-detail/1">
                    <img src="{{ asset('assets/Logo.png') }}" alt="News 1" class="rounded-lg shadow-md">
                </a>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide">
                <a href="/news-detail/2">
                    <img src="{{ asset('assets/Logo.png') }}" alt="News 2" class="rounded-lg shadow-md">
                </a>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide">
                <a href="/news-detail/3">
                    <img src="{{ asset('assets/Logo.png') }}" alt="News 3" class="rounded-lg shadow-md">
                </a>
            </div>
        </div>
        <!-- Pagination & Navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<!-- Forum Diskusi -->
<section class="bg-gray-200 py-16 text-center">
    <h2 class="text-4xl font-bold">💬 Forum Diskusi</h2>
    <p class="mt-4">Bergabung dalam diskusi buku, bagikan ulasan, dan berinteraksi dengan sesama pecinta buku.</p>

    <!-- Discord Section -->
    <div class="mt-6">
        <p class="text-lg">Gabung di server Discord kami untuk diskusi lebih seru! 🎙️📚</p>
        <a href="https://discord.gg/contohlink" target="_blank" class="mt-4 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-700 transition">
            🔗 Join Discord
        </a>
    </div>
</section>

<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });
</script>
@endsection