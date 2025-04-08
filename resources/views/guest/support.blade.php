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

    .bg-overlay {
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(2px);
    }
</style>

<div class="bg-hero pt-20 pb-10 min-h-screen flex items-start">
    <div class="max-w-6xl mx-auto px-6 py-10 mt-16 mb-16 bg-white bg-overlay rounded-lg shadow-lg w-full">
        <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">Support & Customer Service</h1>
        <p class="text-gray-600 text-center mb-10">
            Need help? We're here to assist you.
        </p>

        <!-- Grid Support Sections -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Contact Section -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2 mb-2">
                    <i class="fas fa-headset text-blue-600"></i> Contact Us
                </h2>
                <ul class="space-y-2 text-gray-700 ml-1">
                    <li><i class="fas fa-envelope text-blue-500 mr-2"></i> 
                        <a href="mailto:support@wihopelibrary.com" class="text-blue-500 hover:underline">support@wihopelibrary.com</a>
                    </li>
                    <li><i class="fas fa-phone text-blue-500 mr-2"></i> +1 (234) 567-890</li>
                    <li><i class="fas fa-comments text-blue-500 mr-2"></i> Live Chat: 24/7 via website</li>
                </ul>
            </div>

            <!-- Social Media Section -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2 mb-2">
                    <i class="fas fa-globe text-green-600"></i> Connect With Us
                </h2>
                <p class="text-gray-700 mb-3">Follow us for news, updates, and more:</p>
                <div class="flex space-x-4 text-xl text-blue-500">
                    <a href="#" class="hover:text-blue-700"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="hover:text-blue-700"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-blue-700"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-blue-700"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <!-- Support Hours -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center gap-2 mb-2">
                    <i class="fas fa-clock text-yellow-600"></i> Support Hours
                </h2>
                <ul class="text-gray-700 ml-1 list-disc pl-4">
                    <li>Mon – Fri: 9:00 AM – 6:00 PM (GMT)</li>
                    <li>Sat – Sun: 10:00 AM – 4:00 PM (GMT)</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
