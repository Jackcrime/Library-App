@extends('layouts.main')
@section('contents')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-center text-3xl font-bold text-purple-700">📖🔥 Reading Challenge</h1>

    <!-- Form Pendaftaran -->
    <div class="mt-6 p-6 bg-green-50 rounded-lg shadow">
        <h3 class="text-lg font-bold text-green-600">📝 Daftar Challenge</h3>
        <form class="mt-4 space-y-4">
            <input type="text" placeholder="Masukkan nama Anda" class="w-full p-2 border border-gray-300 rounded">
            <input type="email" placeholder="Masukkan email Anda" class="w-full p-2 border border-gray-300 rounded">
            <select class="w-full p-2 border border-gray-300 rounded">
                <option>Pemula - 5 Buku</option>
                <option>Menengah - 10 Buku</option>
                <option>Ahli - 20 Buku</option>
            </select>
            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700">Daftar Sekarang</button>
        </form>
    </div>

    <!-- Leaderboard -->
    <div class="mt-6 p-6 bg-yellow-50 rounded-lg shadow">
        <h3 class="text-lg font-bold text-yellow-600">🏆 Leaderboard</h3>
        <table class="w-full mt-4 border-collapse border border-gray-300">
            <thead>
                <tr class="bg-yellow-200">
                    <th class="border border-gray-300 p-2">Peringkat</th>
                    <th class="border border-gray-300 p-2">Nama</th>
                    <th class="border border-gray-300 p-2">Poin</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-300 p-2">🥇 1</td>
                    <td class="border border-gray-300 p-2">Ari</td>
                    <td class="border border-gray-300 p-2">300 Poin</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">🥈 2</td>
                    <td class="border border-gray-300 p-2">Budi</td>
                    <td class="border border-gray-300 p-2">250 Poin</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 p-2">🥉 3</td>
                    <td class="border border-gray-300 p-2">Citra</td>
                    <td class="border border-gray-300 p-2">200 Poin</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Progress Tracker -->
    <div class="mt-6 p-6 bg-blue-50 rounded-lg shadow">
        <h3 class="text-lg font-bold text-blue-600">📈 Progress Tracker</h3>
        <p class="mt-2">Anda telah membaca <strong>8 dari 10</strong> buku bulan ini!</p>
        <div class="w-full bg-gray-300 rounded-full h-4 mt-2">
            <div class="bg-green-500 h-4 rounded-full" style="width: 80%"></div>
        </div>
    </div>

    <!-- Badge & Reward Collection -->
    <div class="mt-6 p-6 bg-red-50 rounded-lg shadow">
        <h3 class="text-lg font-bold text-red-600">🏅 Koleksi Badge & Hadiah</h3>
        <p class="mt-2">Anda telah mendapatkan: </p>
        <ul class="list-disc ml-6 mt-2">
            <li>🎖️ Badge "Book Explorer"</li>
            <li>🎖️ Badge "Book Master"</li>
            <li>🎁 Diskon Buku 10%</li>
        </ul>
    </div>

    <!-- Rekomendasi Buku -->
    <div class="mt-6 p-6 bg-gray-50 rounded-lg shadow">
        <h3 class="text-lg font-bold text-gray-700">📚 Rekomendasi Buku</h3>
        <ul class="list-disc ml-6 mt-2">
            <li><strong>Pemula</strong>: "Atomic Habits" - James Clear</li>
            <li><strong>Menengah</strong>: "Sapiens" - Yuval Noah Harari</li>
            <li><strong>Ahli</strong>: "War and Peace" - Leo Tolstoy</li>
        </ul>
    </div>
</div>
@endsection