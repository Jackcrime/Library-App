@extends('layouts.nav')

@section('contents')
<div x-data="{
    showModal: false,
    book: { title: '', cover: '', author: '', publisher: '', isbn: '', year: '', description: '', rating: 0 },
    searchQuery: '',
    favoriteBooks: [],
    wishlist: [],
    userReviews: {},
    selectedCategory: '',
    notification: '',
    showNotification: false,
    newReview: '',
    showBook(id, title, cover, author, publisher, isbn, year, description, rating, kategori) {
        this.book = { id, title, cover, author, publisher, isbn, year, description, rating, kategori };
        this.showModal = true;
        this.newReview = '';
    },
    addReview(bookId, review) {
        if (review.trim() === '') {
            this.notification = 'Ulasan tidak boleh kosong!';
            this.showNotification = true;
            return;
        }

        fetch(`/books/${bookId}/reviews`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ review })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.notification = 'Ulasan berhasil dikirim!';
                this.showNotification = true;
                this.newReview = '';
            } else {
                this.notification = 'Gagal mengirim ulasan. Silakan coba lagi.';
                this.showNotification = true;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            this.notification = 'Terjadi kesalahan. Silakan coba lagi.';
            this.showNotification = true;
        });
    }
}" class="p-6 min-h-screen transition-all duration-300 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white">

    <!-- Header -->
    <div class="container mx-auto text-center mt-10">
        <h1 class="text-5xl font-extrabold tracking-wide">Discovery Library</h1>
        <p class="text-lg text-gray-600 dark:text-gray-300 mt-2">Temukan buku berdasarkan kategori</p>
    </div>

    <!-- Notification -->
    <div x-show="showNotification" class="fixed top-0 right-0 m-4 p-4 bg-green-500 text-white rounded-lg" x-text="notification"></div>

    <!-- Buku Populer -->
    <div class="container mx-auto mt-10">
        <h2 class="text-4xl font-semibold text-center mb-8">Buku Populer</h2>
        <div class="overflow-hidden" style="scroll-behavior: smooth;">
            <div class="flex gap-4">
                @foreach($bukusPopuler as $book)
                <div class="relative group bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden transform transition-all hover:scale-105 w-64">
                    <img src="{{ asset('storage/' . $book->foto) }}" alt="{{ $book->judul }}" class="w-full h-80 object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:opacity-100 opacity-0 flex flex-col justify-between p-5">
                        <h2 class="text-xl font-semibold text-white truncate">{{ $book->judul }}</h2>
                        <div class="flex items-center justify-center gap-4 mt-auto pb-2">
                            <button id="fav-{{ $book->id }}" class="favorite-btn text-white border-2 border-white rounded-full w-10 h-10 flex items-center justify-center transition-all hover:bg-red-500 hover:border-red-500">
                                <i class="fas fa-heart text-sm"></i>
                            </button>
                            <button @click="showBook({{ $book->id }}, {!! json_encode($book->judul) !!}, '{{ asset('storage/' . $book->foto) }}', {!! json_encode($book->penulis) !!}, {!! json_encode($book->penerbit) !!}, {!! json_encode($book->isbn) !!}, {!! json_encode($book->tahun) !!}, {!! json_encode($book->deskripsi) !!}, {{ $book->rating }}, '{{ $book->kategori ? $book->kategori->nama : 'Tanpa Kategori' }}')"
                                id="detail-{{ $book->id }}"
                                class="bg-blue-500 text-white font-bold py-2 px-6 rounded-md text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100 w-auto hover:bg-blue-600">
                                Detail
                            </button>
                            <button id="bookmark-{{ $book->id }}" class="bookmark-btn text-white border-2 border-white rounded-full w-10 h-10 flex items-center justify-center transition-all hover:bg-yellow-500 hover:border-yellow-500">
                                <i class="fas fa-bookmark text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Buku Baru -->
    <div class="container mx-auto mt-10">
        <h2 class="text-4xl font-semibold text-center mb-8">Buku Baru</h2>
        <div class="overflow-hidden" style="scroll-behavior: smooth;">
            <div class="flex gap-4">
                @foreach($bukusBaru as $book)
                <div class="relative group bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden transform transition-all hover:scale-105 w-64">
                    <img src="{{ asset('storage/' . $book->foto) }}" alt="{{ $book->judul }}" class="w-full h-80 object-cover transition-transform duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-40 transition-opacity duration-300 group-hover:opacity-100 opacity-0 flex flex-col justify-between p-5">
                        <h2 class="text-xl font-semibold text-white truncate">{{ $book->judul }}</h2>
                        <div class="flex items-center justify-center gap-4 mt-auto pb-2">
                            <button id="fav-{{ $book->id }}" class="favorite-btn text-white border-2 border-white rounded-full w-10 h-10 flex items-center justify-center transition-all hover:bg-red-500 hover:border-red-500">
                                <i class="fas fa-heart text-sm"></i>
                            </button>
                            <button @click="showBook({{ $book->id }}, {!! json_encode($book->judul) !!}, '{{ asset('storage/' . $book->foto) }}', {!! json_encode($book->penulis) !!}, {!! json_encode($book->penerbit) !!}, {!! json_encode($book->isbn) !!}, {!! json_encode($book->tahun) !!}, {!! json_encode($book->deskripsi) !!}, {{ $book->rating }}, '{{ $book->kategori ? $book->kategori->nama : 'Tanpa Kategori' }}')"
                                id="detail-{{ $book->id }}"
                                class="bg-blue-500 text-white font-bold py-2 px-6 rounded-md text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100 w-auto hover:bg-blue-600">
                                Detail
                            </button>
                            <button id="bookmark-{{ $book->id }}" class="bookmark-btn text-white border-2 border-white rounded-full w-10 h-10 flex items-center justify-center transition-all hover:bg-yellow-500 hover:border-yellow-500">
                                <i class="fas fa-bookmark text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mx-auto mt-10 mb-10">
        <div class="flex justify-center space-x-4 overflow-hidden">
            <button class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105" onclick="filterBooks('')">
                Semua Kategori
            </button>
            <div class="flex space-x-4 overflow-x-auto py-2 px-2" style="scroll-behavior: smooth;">
                @foreach($kategoris as $kategori)
                <button class="bg-gray-300 text-gray-800 py-2 px-6 rounded-lg hover:bg-gray-400 transition duration-300 ease-in-out transform hover:scale-105" onclick="filterBooks('{{ $kategori->id }}')">
                    {{ $kategori->nama }}
                </button>
                @endforeach
            </div>
            <div id="books-list" class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($books as $book)
                <div class="bg-white p-4 border rounded-lg shadow-md">
                    <h3 class="font-semibold text-lg">{{ $book->title }}</h3>
                    <p class="text-gray-600">{{ $book->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Detail Buku -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-2xl max-w-4xl w-full h-auto relative absolute top-10">
            <button @click="showModal = false" class="absolute top-3 right-3 text-gray-600 dark:text-gray-300 hover:text-red-600">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex flex-col md:flex-row gap-6">
                <img :src="book.cover" class="w-full md:w-1/3 rounded-lg shadow-md">
                <div class="w-full md:w-2/3">
                    <h2 x-text="book.title" class="text-2xl font-bold"></h2>
                    <p class="mt-2"><i class="fas fa-user"></i> <strong>Penulis:</strong> <span x-text="book.author"></span></p>
                    <p><i class="fas fa-building"></i> <strong>Penerbit:</strong> <span x-text="book.publisher"></span></p>
                    <p><i class="fas fa-barcode"></i> <strong>ISBN:</strong> <span x-text="book.isbn"></span></p>
                    <p><i class="fas fa-calendar-alt"></i> <strong>Tahun:</strong> <span x-text="book.year"></span></p>
                    <p><i class="fa fa-tag"></i> <strong>Kategori:</strong> <span x-text="book.kategori"></span></p>
                    <p class="mt-3"><i class="fas fa-info-circle"></i> <strong>Deskripsi:</strong> <span x-text="book.description"></span></p>

                    <!-- Rating -->
                    <div class="mt-4">
                        <p><i class="fas fa-star"></i> <strong>Rating:</strong></p>
                        <div x-data="{ rating: book.rating }">
                            <template x-for="star in 5">
                                <span @click="rating = star" :class="rating >= star ? 'text-yellow-400' : 'text-gray-400'">
                                    <i class="fas fa-star"></i>
                                </span>
                            </template>
                        </div>
                    </div>

                    <!-- Review -->
                    <textarea x-model="newReview" class="w-full p-3 mt-4 border rounded-lg text-black" placeholder="Tulis ulasan..."></textarea>
                    <button @click="addReview(book.id, newReview)" class="mt-2 w-full py-2 bg-blue-500 text-white rounded-lg">
                        <i class="fas fa-paper-plane"></i> Kirim Ulasan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript for category selection and filtering
    function filterBooks(categoryId) {
        const booksList = document.getElementById('books-list');

        fetch(`/filter-books?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                booksList.innerHTML = data.books.map(book => `
                    <div class="bg-white p-4 border rounded-lg shadow-md">
                        <h3 class="font-semibold text-lg">${book.title}</h3>
                        <p class="text-gray-600">${book.description}</p>
                    </div>
                `).join('');
            });
    }

    // Handle click events for favorite and bookmark buttons
    document.querySelectorAll('.favorite-btn').forEach(button => {
        button.addEventListener('click', () => {
            const bookId = button.id.split('-')[1];
            button.classList.toggle('text-red-500');
            button.classList.toggle('text-white');
            button.classList.toggle('border-red-500');
            button.classList.toggle('border-white');
        });
    });

    document.querySelectorAll('.bookmark-btn').forEach(button => {
        button.addEventListener('click', () => {
            const bookId = button.id.split('-')[1];
            button.classList.toggle('text-blue-500');
            button.classList.toggle('text-white');
            button.classList.toggle('border-blue-500');
            button.classList.toggle('border-white');
        });
    });
</script>

@endsection