@extends('layouts.main')

@section('contents')
<div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg mt-10">
    <h1 class="text-4xl font-bold mb-6 text-center">Support & Customer Service</h1>
    <p class="text-gray-700 text-center">We're here to help! Find answers to common questions or reach out to our support team.</p>

    <h2 class="text-2xl font-semibold mt-8">📞 Contact Us</h2>
    <p class="text-gray-700">For any issues, feel free to get in touch with our support team:</p>
    
    <ul class="list-disc pl-6 text-gray-700 mt-2">
        <li>📧 Email: <a href="mailto:support@wihopelibrary.com" class="text-blue-500 hover:underline">support@wihopelibrary.com</a></li>
        <li>📞 Phone: +1 (234) 567-890</li>
        <li>💬 Live Chat: Available 24/7 via our website</li>
        <li>📩 Ticket System: Submit a request <a href="#" class="text-blue-500 hover:underline">here</a></li>
    </ul>

    <h2 class="text-2xl font-semibold mt-8">💡 Frequently Asked Questions (FAQ)</h2>
    <p class="text-gray-700">
        Before contacting support, check out our <a href="#" class="text-blue-500 hover:underline">FAQ page</a> for quick answers to common issues.
    </p>

    <h2 class="text-2xl font-semibold mt-8">🌍 Connect With Us</h2>
    <p class="text-gray-700">Follow us on social media for updates and announcements:</p>
    
    <div class="flex space-x-4 mt-4">
        <a href="#" class="text-blue-500 text-xl hover:text-blue-700"><i class="fab fa-facebook"></i></a>
        <a href="#" class="text-blue-500 text-xl hover:text-blue-700"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-blue-500 text-xl hover:text-blue-700"><i class="fab fa-instagram"></i></a>
        <a href="#" class="text-blue-500 text-xl hover:text-blue-700"><i class="fab fa-linkedin"></i></a>
    </div>

    <h2 class="text-2xl font-semibold mt-8">🕒 Support Hours</h2>
    <p class="text-gray-700">
        Our support team is available during the following hours:
    </p>
    <ul class="list-disc pl-6 text-gray-700 mt-2">
        <li>Monday - Friday: 9:00 AM - 6:00 PM (GMT)</li>
        <li>Saturday - Sunday: 10:00 AM - 4:00 PM (GMT)</li>
    </ul>
</div>
@endsection
