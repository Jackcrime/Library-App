@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-book text-blue-600 mr-3"></i> Daftar Buku
        </h2>
        <div class="flex gap-3">
            <form action="{{ route('bukus.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" placeholder="Cari nama buku..." class="border rounded-lg px-4 py-2 w-72 focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="{{ route('bukus.create') }}" class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition gap-2">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-5 flex items-center">
        <i class="fas fa-check-circle mr-2 pb-1"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Tabel Buku -->
    <div class="overflow-hidden rounded-lg shadow-lg">
        <table class="w-full border text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-5 py-3 text-left">ID</th>
                    <th class="px-5 py-3 text-left">Judul</th>
                    <th class="px-5 py-3 text-left">Kategori</th>
                    <th class="px-5 py-3 text-left">Penulis</th>
                    <th class="px-5 py-3 text-left">Penerbit</th>
                    <th class="px-5 py-3 text-left">ISBN</th>
                    <th class="px-5 py-3 text-left">Tahun</th>
                    <th class="px-5 py-3 text-left">Foto</th>
                    <th class="px-5 py-3 text-left">Jumlah</th>
                    <th class="px-5 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($bukus as $buku)
                <tr class="border-b hover:bg-gray-100 transition">
                    <td class="px-5 py-3">{{ $loop->iteration }}</td>
                    <td class="px-5 py-3">{{ $buku->judul }}</td>
                    <td class="px-5 py-3">{{ $buku->kategori->nama }}</td>
                    <td class="px-5 py-3">{{ $buku->penulis }}</td>
                    <td class="px-5 py-3">{{ $buku->penerbit }}</td>
                    <td class="px-5 py-3">{{ $buku->isbn }}</td>
                    <td class="px-5 py-3">{{ $buku->tahun }}</td>
                    <td class="border p-2 text-center">
                        @if ($buku->foto)
                        <img src="{{ asset('storage/' . $buku->foto) }}" alt="Foto Buku" class="w-16 h-16 object-cover mx-auto">
                        @else
                        <span class="text-gray-500">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="px-5 py-3">{{ $buku->jumlah }}</td>
                    <td class="px-5 py-3 flex gap-2 justify-center">
                        <a href="{{ route('bukus.edit', $buku->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition flex items-center justify-center">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition flex items-center justify-center" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination & Filter -->
    <div class="flex justify-between items-center mt-6">
        <form action="{{ route('bukus.index') }}" method="GET" class="flex items-center gap-3">
            <label class="font-semibold">Tampilkan</label>
            <select name="perPage" class="border rounded-lg px-4 py-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ request('perPage') == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
            </select>
        </form>
        <div>
            {{ $bukus->appends(['perPage' => request('perPage')])->links() }}
        </div>
    </div>
</div>
@endsection