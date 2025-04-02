@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-book-open text-blue-600 mr-3"></i> Daftar Peminjaman
        </h2>
        <div class="flex gap-3">
            <form action="{{ route('pinjams.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" placeholder="Cari nama peminjam..." class="border rounded-lg px-4 py-2 w-72 focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="{{ route('pinjams.create') }}" class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition gap-2">
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

    <!-- Tabel Peminjaman -->
    <div class="overflow-hidden rounded-lg shadow-lg">
        <table class="w-full border text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-5 py-3 text-left">ID</th>
                    <th class="px-5 py-3 text-left">Nama Peminjam</th>
                    <th class="px-5 py-3 text-left">Judul Buku</th>
                    <th class="px-5 py-3 text-left">Tanggal Pinjam</th>
                    <th class="px-5 py-3 text-left">Tanggal Kembali</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($pinjams as $pinjam)
                <tr class="border-b hover:bg-gray-100 transition">
                    <td class="px-5 py-3">{{ $loop->iteration }}</td>
                    <td class="px-5 py-3">{{ $pinjam->user->nama }}</td>
                    <td class="px-5 py-3">{{ $pinjam->buku->judul }}</td>
                    <td class="px-5 py-3">{{ $pinjam->tgl_pinjam }}</td>
                    <td class="px-5 py-3">{{ $pinjam->tgl_kembali }}</td>
                    <td class="px-5 py-3">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $pinjam->status == 'pinjam' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $pinjam->status == 'pinjam' ? 'Dipinjam' : 'Dikembalikan' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 flex gap-2 justify-center">
                        @if ($pinjam->deleted_at)
                            <form action="{{ route('pinjams.restore', $pinjam->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition flex items-center">
                                    <i class="fas fa-undo mr-1"></i> Pulihkan
                                </button>
                            </form>
                            <form action="{{ route('pinjams.forceDelete', $pinjam->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-800 transition flex items-center" onclick="return confirm('Data ini akan dihapus permanen. Lanjutkan?')">
                                    <i class="fas fa-user-times mr-1"></i> Hapus Permanen
                                </button>
                            </form>
                        @else
                            <a href="{{ route('pinjams.edit', $pinjam->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('pinjams.destroy', $pinjam->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition" onclick="return confirm('Yakin ingin menghapus peminjaman ini?')">
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
        <form action="{{ route('pinjams.index') }}" method="GET" class="flex items-center gap-3">
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
            {{ $pinjams->appends(['perPage' => request('perPage')])->links() }}
        </div>
    </div>
</div>
@endsection