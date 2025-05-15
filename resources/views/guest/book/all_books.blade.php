@extends('layouts.nav')

@section('contents')
<div class="m-10" x-data="{
    open: false,
    showForm: false,
    isBorrowed: false,
    openImagePreview: false,
    book: {},
    isFavorited: false,
    isBookmarked: false,
        initBook(book) {
        this.book = book;
        this.isFavorited = localStorage.getItem('favorited_' + book.id) === 'true';
        this.isBookmarked = localStorage.getItem('bookmarked_' + book.id) === 'true';
    },

    toggleFavorite() {
        this.isFavorited = !this.isFavorited;
        localStorage.setItem('favorited_' + this.book.id, this.isFavorited);

        fetch(`/book/favorite/${this.book.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            this.isFavorited = data.status === 'added';
            localStorage.setItem('favorited_' + this.book.id, this.isFavorited);

            Swal.fire({
                icon: data.status === 'added' ? 'success' : 'info',
                title: data.status === 'added' ? 'Berhasil ditambahkan ke Favorit!' : 'Dihapus dari Favorit!',
                showConfirmButton: false,
                timer: 1500
            });
        })
        .catch(error => console.error('Error favoriting the book:', error));
    },

    toggleBookmark() {
        this.isBookmarked = !this.isBookmarked;
        localStorage.setItem('bookmarked_' + this.book.id, this.isBookmarked);

        fetch(`/book/bookmark/${this.book.id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            this.isBookmarked = data.status === 'added';
            localStorage.setItem('bookmarked_' + this.book.id, this.isBookmarked);

            Swal.fire({
                icon: data.status === 'added' ? 'success' : 'info',
                title: data.status === 'added' ? 'Berhasil dibookmark!' : 'Bookmark dihapus!',
                showConfirmButton: false,
                timer: 1500
            });
        })
        .catch(error => console.error('Error bookmarking the book:', error));
    }
}">
    <h1 class="text-5xl font-extrabold text-center mb-14 pt-10 text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-teal-400 to-emerald-200 animate-pulse drop-shadow-md">
        All Book
    </h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($books as $buku)
        <div class="group relative rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition duration-300 min-h-[400px]">
            <img src="{{ $buku->foto ? asset('storage/' . $buku->foto) : 'https://via.placeholder.com/150' }}"
                alt="{{ $buku->judul }}"
                class="w-full h-full object-cover transition duration-500 group-hover:scale-110">

            <div class="absolute top-0 left-0 right-0 bg-black/60 text-white text-center py-2 opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition duration-300 z-10">
                <h3 class="text-base font-semibold truncate px-4">{{ $buku->judul }}</h3>
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 p-4">
                <button @click="open = true; initBook({{ json_encode($buku) }})"
                    class="text-white bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded-lg font-semibold shadow-md ring-2 ring-blue-300 hover:ring-4 transition-all duration-300">
                    View Details
                </button>
            </div>
        </div>
        @endforeach
    </div>
    <!-- CTA Button -->
    <div class="mt-16 text-center">
        <a href="{{ route('book') }}"
            class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 via-teal-500 to-indigo-500 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition-transform duration-300 shadow-xl hover:shadow-2xl">
            <i class="fas fa-arrow-left"></i> Back to Discover
        </a>
    </div>
    <!-- Wrapper backdrop -->
    <div x-show="open" @click.away="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-black/70 p-6 transition-all duration-300 ease-in-out"
        x-cloak>

        <!-- Modal content -->
        <div class="bg-white/30 backdrop-blur-xl rounded-3xl shadow-[0_8px_32px_0_rgba(31,38,135,0.37)] border border-white/40 w-full max-w-5xl px-8 py-6 relative animate-fade-in-down text-gray-800 transition-all duration-300">

            <!-- Close button -->
            <button @click="open = false"
                class="absolute top-4 right-4 text-white hover:text-red-500 text-3xl font-bold transition-all duration-200 z-50">
                &times;
            </button>

            <!-- Container for Image + Info -->
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Book Image -->
                <div class="md:w-1/2 w-full aspect-[3/4] md:aspect-[4/5] overflow-hidden rounded-2xl shadow-lg ring-1 ring-black/10">
                    <img :src="book.foto ? '/storage/' + book.foto : 'https://via.placeholder.com/150'"
                        alt="Book Cover"
                        class="w-full h-full object-cover object-center hover:scale-105 transition-transform duration-500 ease-in-out rounded-xl">
                </div>

                <!-- Book Info -->
                <div class="md:w-1/2 w-full">
                    <!-- Title -->
                    <h3 class="text-3xl font-extrabold text-white text-center md:text-left mb-4 tracking-tight drop-shadow-md" x-text="book.judul"></h3>

                    <!-- Detail Info -->
                    <ul class="text-white/90 text-sm space-y-2 mb-4">
                        <li><i class="fas fa-pen-nib text-blue-300 mr-2"></i><strong>Author:</strong> <span x-text="book.penulis"></span></li>
                        <li><i class="fas fa-building text-green-300 mr-2"></i><strong>Publisher:</strong> <span x-text="book.penerbit"></span></li>
                        <li><i class="fas fa-barcode text-purple-300 mr-2"></i><strong>ISBN:</strong> <span x-text="book.isbn"></span></li>
                        <li><i class="fas fa-calendar-alt text-orange-300 mr-2"></i><strong>Year:</strong> <span x-text="book.tahun"></span></li>
                        <li><i class="fas fa-layer-group text-teal-300 mr-2"></i><strong>Copies:</strong> <span x-text="book.jumlah"></span></li>
                    </ul>

                    <!-- Synopsis -->
                    <div class="bg-white/80 text-gray-900 text-sm rounded-xl px-4 py-3 border border-white/60 shadow-inner max-h-40 overflow-y-auto backdrop-blur-sm">
                        <p x-text="book.deskripsi"></p>
                    </div>

                    <!-- Favorite / Bookmark / Borrow -->
                    <div class="flex flex-wrap gap-4 mt-5">
                        <button @click="toggleFavorite"
                            :class="isFavorited ? 'bg-red-600' : 'bg-red-500'"
                            class="text-white px-4 py-2 rounded-xl shadow-lg flex items-center gap-2 transition-all duration-300 hover:scale-105">
                            <i :class="isFavorited ? 'fas fa-heart' : 'far fa-heart'"></i>
                            <span x-text="isFavorited ? 'Favorited' : 'Favorite'"></span>
                        </button>

                        <button type="button"
                            @click="showForm = true"
                            class="bg-blue-500 text-white px-4 py-2 rounded-xl shadow-lg flex items-center gap-2 transition-all duration-300 hover:scale-105">
                            <i class="fas fa-book"></i>
                            <span>Borrow</span>
                        </button>

                        <button @click="toggleBookmark"
                            :class="isBookmarked ? 'bg-yellow-600' : 'bg-yellow-500'"
                            class="text-white px-4 py-2 rounded-xl shadow-lg flex items-center gap-2 transition-all duration-300 hover:scale-105">
                            <i :class="isBookmarked ? 'fas fa-bookmark' : 'far fa-bookmark'"></i>
                            <span x-text="isBookmarked ? 'Bookmarked' : 'Bookmark'"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Formulir Peminjaman -->
    <div x-show="showForm" x-cloak
        class="fixed inset-0 flex items-center justify-center z-50 bg-black/60 backdrop-blur-sm transition duration-300">

        <div @click.away="showForm = false"
            class="bg-white rounded-2xl p-6 w-full max-w-4xl shadow-xl relative">

            <!-- Tombol Close -->
            <button @click="showForm = false"
                class="absolute top-3 right-4 text-xl font-bold text-gray-700 hover:text-red-500">
                &times;
            </button>

            <!-- Grid Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Kolom Kiri: Formulir -->
                <div>
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Formulir Peminjaman Buku</h2>

                    <form method="POST" action="{{ route('guest.pinjam') }}">
                        @csrf
                        <input type="hidden" name="buku_id" :value="book.id">

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="text-sm text-gray-700">Nama</label>
                            <input type="text" value="{{ Auth::user()->nama }}" disabled
                                class="w-full mt-1 px-4 py-2 bg-gray-100 rounded-lg border border-gray-300 cursor-not-allowed">
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div class="mb-3">
                            <label class="text-sm text-gray-700">Tanggal Pinjam</label>
                            <input type="date" name="tgl_pinjam"
                                value="{{ now()->format('Y-m-d') }}"
                                class="w-full mt-1 px-4 py-2 rounded-lg border border-gray-300">
                        </div>

                        <!-- Tanggal Kembali -->
                        <div class="mb-4">
                            <label class="text-sm text-gray-700">Tanggal Kembali</label>
                            <input type="date" name="tgl_kembali"
                                value="{{ now()->addDays(7)->format('Y-m-d') }}"
                                class="w-full mt-1 px-4 py-2 rounded-lg border border-gray-300">
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="showForm = false"
                                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Pinjam
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Modal Preview Gambar -->
                <div
                    x-show="openImagePreview"
                    x-cloak
                    @click.away="openImagePreview = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm transition duration-300">
                    <div class="relative">
                        <!-- Tombol Close -->
                        <button
                            @click="openImagePreview = false"
                            class="absolute top-2 right-2 z-10 text-white text-3xl font-bold hover:text-red-400 transition">
                            &times;
                        </button>

                        <!-- Gambar Preview -->
                        <img
                            :src="book.foto ? '/storage/' + book.foto : 'https://via.placeholder.com/300x400'"
                            alt="Book Preview"
                            class="max-w-full max-h-screen rounded-lg shadow-2xl">
                    </div>
                </div>

                <!-- Kolom Gambar Buku dengan Judul (klik untuk preview) -->
                <div class="relative w-full h-60 rounded-lg overflow-hidden shadow-lg cursor-pointer"
                    @click="openImagePreview = true">
                    <!-- Gambar -->
                    <img
                        :src="book.foto ? '/storage/' + book.foto : 'https://via.placeholder.com/300x400'"
                        alt="Book Cover"
                        class="w-full h-full object-cover object-top transition duration-300 hover:scale-105">

                    <!-- Judul Buku -->
                    <div class="absolute top-0 left-0 w-full bg-black/50 px-4 py-2">
                        <h3 class="text-white text-base font-semibold truncate" x-text="book.judul"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection