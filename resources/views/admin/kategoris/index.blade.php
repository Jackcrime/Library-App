@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-folder text-blue-600 mr-3"></i> Daftar Kategori
        </h2>
        <div class="flex gap-3">
            <form action="{{ route('kategoris.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" placeholder="Cari nama kategori..." class="border rounded-lg px-4 py-2 w-72 focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="{{ route('kategoris.create') }}" class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition gap-2">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-5 flex items-center">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Tabel Kategori -->
    <div class="overflow-hidden rounded-lg shadow-lg">
        <table class="w-full border text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-5 py-3 text-left">ID</th>
                    <th class="px-5 py-3 text-left">Nama</th>
                    <th class="px-5 py-3 text-left">Deskripsi</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($kategoris as $kategori)
                <tr class="border-b hover:bg-gray-100 transition">
                    <td class="px-5 py-3">{{ $loop->iteration }}</td>
                    <td class="px-5 py-3">{{ $kategori->nama }}</td>
                    <td class="px-5 py-3">{{ $kategori->deskripsi }}</td>
                    <td class="px-5 py-3">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $kategori->deleted_at ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $kategori->deleted_at ? 'Terhapus' : 'Aktif' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 flex gap-2 justify-center">
                        @if($kategori->deleted_at)
                        <form action="{{ route('kategoris.restore', $kategori->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">Pulihkan</button>
                        </form>
                        <form action="{{ route('kategoris.forceDelete', $kategori->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-800 transition" onclick="return confirm('Kategori ini akan dihapus permanen. Lanjutkan?')">Hapus Permanen</button>
                        </form>
                        @else
                        <a href="{{ route('kategoris.edit', $kategori->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination & Filter -->
    <div class="flex justify-between items-center mt-6">
        <form action="{{ route('kategoris.index') }}" method="GET" class="flex items-center gap-3">
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
            {{ $kategoris->appends(['perPage' => request('perPage')])->links() }}
        </div>
    </div>
</div>
@endsection