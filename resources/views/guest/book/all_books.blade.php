@extends('layouts.nav')

@section('contents')
<div class="m-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">All Books</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($books as $buku)
        <div class="relative group bg-white shadow-md hover:shadow-xl rounded-xl overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
            <img src="{{ $buku->foto ? asset('storage/' . $buku->foto) : 'https://via.placeholder.com/150' }}"
                alt="{{ $buku->judul }}" class="w-full h-64 object-cover">
            <div
                class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <button @click="open = true; book = {{ json_encode($buku) }}"
                    class="text-white font-semibold text-lg bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    View Details
                </button>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        <a href="{{ route('book') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Back to Home</a>
    </div>
</div>
@endsection