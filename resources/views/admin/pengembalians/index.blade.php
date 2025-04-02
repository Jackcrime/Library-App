@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-book-open text-blue-600 mr-3"></i> Daftar Pengembalian
        </h2>
        <form action="{{ route('pinjams.index') }}" method="GET" class="flex gap-3">
            <input type="text" name="search" placeholder="Cari nama peminjam..." class="border rounded-lg px-4 py-2 w-72 focus:ring-2 focus:ring-blue-500" value="{{ request('search') }}">
            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-5 flex items-center">
        <i class="fas fa-check-circle mr-2 pb-1"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Notes -->
    <div class="bg-gray-100 p-4 rounded-lg shadow mb-6">
        <h3 class="text-lg font-semibold mb-2">Keterangan Status:</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div class="flex items-center"><i class="fas fa-exclamation-circle text-yellow-500 mr-2"></i> Peringatan 1</div>
            <div class="flex items-center"><i class="fas fa-bell text-orange-500 mr-2"></i> Peringatan 2</div>
            <div class="flex items-center"><i class="fas fa-exclamation-triangle text-red-500 mr-2"></i> Peringatan 3</div>
            <div class="flex items-center"><i class="fas fa-check-circle text-green-500 mr-2"></i> Lunas</div>
        </div>
    </div>

    <!-- Tabel Pengembalian -->
    <div class="overflow-hidden rounded-lg shadow-lg">
        <table class="w-full border text-sm">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-5 py-3 text-left">User</th>
                    <th class="px-5 py-3 text-left">Buku</th>
                    <th class="px-5 py-3 text-left">Tanggal Kembali</th>
                    <th class="px-5 py-3 text-left">Terlambat (Hari)</th>
                    <th class="px-5 py-3 text-left">Denda</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($pengembalians as $p)
                <tr class="border-b hover:bg-gray-100 transition">
                    <td class="px-5 py-3">{{ $p->user->nama }}</td>
                    <td class="px-5 py-3">{{ $p->buku->judul }}</td>
                    <td class="px-5 py-3">{{ $p->tgl_kembali }}</td>
                    @php
                    $tglKembali = \Carbon\Carbon::parse($p->tgl_kembali);
                    $hariTerlambat = now()->greaterThan($tglKembali) ? (int) $tglKembali->diffInDays(now()) : 0;

                    // Menentukan warna berdasarkan hari keterlambatan
                    $bgColor = $hariTerlambat == 0 ? 'bg-green-100 text-green-600' :
                    ($hariTerlambat <= 1 ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600' );
                        @endphp


                        <td class="px-5 py-3">
                        <span class="px-3 py-1 rounded-full text-sm  {{ $bgColor }}">
                            {{ $hariTerlambat }} Hari
                        </span>
                        </td>
                        <td class="px-5 py-3">Rp{{ number_format($p->denda, 0, ',', '.') }}</td>
                        <td class="px-5 py-3">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $p->pinjam->status == 'pinjam' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                {{ $p->pinjam->status == 'pinjam' ? 'Dipinjam' : 'Dikembalikan' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 flex flex-wrap gap-2 justify-center">
                            <form action="{{ route('pengembalians.peringatan', [$p->id, 1]) }}" method="POST">
                                @csrf
                                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition"><i class="fas fa-exclamation-circle"></i></button>
                            </form>
                            <form action="{{ route('pengembalians.peringatan', [$p->id, 2]) }}" method="POST">
                                @csrf
                                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition"><i class="fas fa-bell"></i></button>
                            </form>
                            <form action="{{ route('pengembalians.peringatan', [$p->id, 3]) }}" method="POST">
                                @csrf
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"><i class="fas fa-exclamation-triangle"></i></button>
                            </form>
                            <form action="{{ route('pengembalians.lunas', $p->id) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition"><i class="fas fa-check-circle"></i></button>
                            </form>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination & Filter -->
    <div class="flex justify-between items-center mt-6">
        <form action="{{ route('pengembalians.index') }}" method="GET" class="flex items-center gap-3">
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
            {{ $pengembalians->appends(['perPage' => request('perPage')])->links() }}
        </div>
    </div>
</div>
@endsection