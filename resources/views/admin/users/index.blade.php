@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-users text-blue-600 mr-3"></i> Daftar Pengguna
        </h2>
        <div class="flex gap-3">
            <form action="{{ route('users.index') }}" method="GET" class="flex gap-3">
                <input type="text" name="search" placeholder="Cari nama pengguna..." class="border rounded-lg px-4 py-2 w-72 focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="{{ route('users.create') }}" class="flex items-center bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition gap-2">
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

    <!-- Tabel Pengguna -->
    <div class="overflow-hidden rounded-lg shadow-lg">
        <table class="w-full border text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-5 py-3 text-left">No</th>
                    <th class="px-5 py-3 text-left">Nama</th>
                    <th class="px-5 py-3 text-left">Email</th>
                    <th class="px-5 py-3 text-left">Jenis</th>
                    <th class="px-5 py-3 text-center">Status</th>
                    <th class="px-5 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @forelse ($users as $index => $user)
                <tr class="border-b hover:bg-gray-100 transition">
                    <td class="px-5 py-3">{{ $loop->iteration }}</td>
                    <td class="px-5 py-3">{{ $user->nama }}</td>
                    <td class="px-5 py-3">{{ $user->email }}</td>
                    <td class="px-5 py-3">{{ ucfirst($user->jenis) }}</td>
                    <td class="px-5 py-3 text-center">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $user->deleted_at ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $user->deleted_at ? 'Terhapus' : 'Aktif' }}
                        </span>
                    </td>
                    <td class="px-5 py-3 flex gap-2 justify-center">
                        @if (!$user->deleted_at)
                        <a href="{{ route('users.edit', $user->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition flex items-center justify-center">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition flex items-center justify-center" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        @else
                        <form action="{{ route('users.restore', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition flex items-center">
                                <i class="fas fa-undo mr-1"></i> Pulihkan
                            </button>
                        </form>
                        <form action="{{ route('users.forceDelete', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-800 transition flex items-center" onclick="return confirm('User ini akan dihapus permanen. Lanjutkan?')">
                                <i class="fas fa-user-times mr-1"></i> Hapus Permanen
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-5 text-center text-gray-500">Tidak ada data pengguna.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination & Filter -->
    <div class="flex justify-between items-center mt-6">
        <form action="{{ route('users.index') }}" method="GET" class="flex items-center gap-3">
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
            {{ $users->appends(['perPage' => request('perPage')])->links() }}
        </div>
    </div>
</div>
@endsection