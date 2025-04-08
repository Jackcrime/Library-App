@extends('layouts.nav')

@section('contents')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <i class="fas fa-bookmark text-blue-600 text-2xl"></i>
        My Bookmarks
    </h1>

    @if($bookmarks->isEmpty())
        <div class="bg-gray-100 p-6 rounded-lg text-center text-gray-600 shadow-md">
            <i class="fas fa-book-open text-gray-400 text-4xl mb-2"></i>
            <p class="text-lg">You haven't bookmarked any books yet.</p>
            <p class="text-sm text-gray-400">Browse and save your favorites!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookmarks as $bookmark)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <img src="{{ $bookmark->buku->foto ? asset('storage/' . $bookmark->buku->foto) : 'https://via.placeholder.com/150' }}" 
                        alt="{{ $bookmark->buku->judul }}" 
                        class="w-full h-64 object-cover">

                    <div class="p-5">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">
                            <i class="fas fa-book text-indigo-600 mr-2"></i>
                            {{ $bookmark->buku->judul }}
                        </h2>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-user text-gray-500 mr-1"></i><strong>Author:</strong> {{ $bookmark->buku->penulis }}</p>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-building text-gray-500 mr-1"></i><strong>Publisher:</strong> {{ $bookmark->buku->penerbit }}</p>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-barcode text-gray-500 mr-1"></i><strong>ISBN:</strong> {{ $bookmark->buku->isbn }}</p>
                        <p class="text-gray-600 text-sm mb-1"><i class="fas fa-calendar-alt text-gray-500 mr-1"></i><strong>Year:</strong> {{ $bookmark->buku->tahun }}</p>
                        <p class="text-gray-600 text-sm mt-2"><i class="fas fa-align-left text-gray-500 mr-1"></i><strong>Description:</strong> {{ Str::limit($bookmark->buku->deskripsi, 100, '...') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
