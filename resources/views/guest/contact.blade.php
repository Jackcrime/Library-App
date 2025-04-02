@extends('layouts.main')
@section('contents')

<style>
    .bg {
        background-image: url('{{ asset("assets/background.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        /* Efek Parallax */
    }

    .form-container {
        backdrop-filter: blur(10px);
        /* Efek blur transparan */
        background-color: rgba(31, 41, 55, 0.8);
        /* Warna semi transparan */
    }
</style>

<section class="bg text-white pt-32 pb-16">
    <div class="max-w-5xl mx-auto text-center px-6">
        <!-- Judul & Deskripsi -->
        <h2 class="text-4xl font-bold mb-4 drop-shadow-lg">Contact Us</h2>
        <p class="max-w-2xl mx-auto text-gray-300">
            Jika Anda memiliki pertanyaan atau ingin bekerja sama dengan kami, jangan ragu untuk menghubungi kami.
        </p>

        <!-- Formulir Kontak -->
        <form action="{{ route('contact.send') }}" method="POST" class="mt-10 form-container p-8 rounded-lg shadow-xl max-w-3xl mx-auto">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Your Name"
                    class="w-full p-3 rounded-md bg-gray-700 text-white placeholder-gray-400 border border-gray-600 
            focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all duration-200" required>

                <input type="email" name="email" placeholder="Your Email"
                    class="w-full p-3 rounded-md bg-gray-700 text-white placeholder-gray-400 border border-gray-600 
            focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all duration-200" required>
            </div>

            <textarea name="message" placeholder="Your Message" rows="5"
                class="w-full p-3 mt-4 rounded-md bg-gray-700 text-white placeholder-gray-400 border border-gray-600 
        focus:ring-2 focus:ring-teal-400 focus:border-teal-400 outline-none transition-all duration-200" required></textarea>

            <button type="submit" class="mt-6 bg-teal-500 px-6 py-3 rounded-full shadow-lg font-semibold text-white transition-all 
        hover:bg-teal-600 hover:scale-105 active:scale-95 focus:ring-4 focus:ring-teal-300">
                Send Message
            </button>
        </form>

    </div>
</section>

@endsection