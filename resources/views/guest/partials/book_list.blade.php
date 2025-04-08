@if(isset($books) && count($books) > 0)
<div x-init="{
    isFavorited: false,
    isBookmarked: false,
    initBook(book) {
        this.book = book;
        this.isFavorited = localStorage.getItem('favorited_' + book.id) === 'true';
        this.isBookmarked = localStorage.getItem('bookmarked_' + book.id) === 'true';
    },
    toggleFavorite() {
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
        })
        .catch(error => console.error('Error favoriting the book:', error));
    },
    toggleBookmark() {
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
        })
        .catch(error => console.error('Error bookmarking the book:', error));
    }
}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full">
    @foreach($books as $buku)
    <div class="group relative rounded-2xl overflow-hidden transform transition duration-300 hover:-translate-y-2 min-h-[400px]">
        <!-- Gambar -->
        <img src="{{ $buku->foto ? asset('storage/' . $buku->foto) : 'https://via.placeholder.com/150' }}"
            alt="{{ $buku->judul }}"
            class="w-full h-full object-cover transform transition duration-300 group-hover:scale-105">

        <!-- Judul muncul saat hover -->
        <div class="absolute top-0 left-0 right-0 bg-black/60 text-white text-center py-2 opacity-0 -translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition duration-300 z-10">
            <h3 class="text-base font-semibold truncate px-4">{{ $buku->judul }}</h3>
        </div>

        <!-- Tombol muncul saat hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent flex items-end justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-4">
            <button @click="open = true; initBook({{ json_encode($buku) }})"
                class="text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-lg font-semibold shadow-md transition duration-300">
                View Details
            </button>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="text-center py-10 col-span-full">
    <p class="text-gray-500">No books found for the selected category.</p>
</div>
@endif