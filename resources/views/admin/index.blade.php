@extends('layouts.app')

@section('content')
<div class="p-6 space-y-10">
    <!-- Title -->
    <div class="my-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
        <p class="text-gray-500">Hi Admin {{ Auth::user()->nama }}!, Selamat datang di panel kontrol perpustakaan.</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card Total Buku -->
        <a href="{{ route('bukus.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md hover:ring-1 hover:ring-blue-200 flex items-center gap-3 transition">
            <i data-lucide="book" class="w-6 h-6 text-blue-600"></i>
            <div>
                <h2 class="text-lg font-semibold">Total Buku</h2>
                <p class="text-2xl font-bold text-blue-600">{{ $totalBuku }}</p>
            </div>
        </a>

        <!-- Card Anggota Terdaftar -->
        <a href="{{ route('users.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md hover:ring-1 hover:ring-green-200 flex items-center gap-3 transition">
            <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
            <div>
                <h2 class="text-lg font-semibold">Anggota Terdaftar</h2>
                <p class="text-2xl font-bold text-green-600">{{ $totalUser }}</p>
            </div>
        </a>

        <!-- Card Kategori Aktif -->
        <a href="{{ route('kategoris.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md hover:ring-1 hover:ring-purple-200 flex items-center gap-3 transition">
            <i data-lucide="tags" class="w-6 h-6 text-purple-600"></i>
            <div>
                <h2 class="text-lg font-semibold">Kategori Aktif</h2>
                <p class="text-2xl font-bold text-purple-600">{{ $totalKategori }}</p>
            </div>
        </a>

        <!-- Card Buku yang Dikembalikan + Modal -->
        <div x-data="{ open: false }">
            <div @click="open = true" class="bg-white p-6 rounded-lg shadow hover:shadow-md hover:ring-1 hover:ring-red-200 cursor-pointer flex items-center gap-3 transition">
                <i data-lucide="check-circle" class="w-6 h-6 text-red-600"></i>
                <div>
                    <h2 class="text-lg font-semibold">Buku yang Dikembalikan</h2>
                    <p class="text-2xl font-bold text-red-600">{{ $totalDikembalikan }}</p>
                </div>
            </div>

            <!-- Modal -->
            <div x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50 bg-black/50">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 relative">
                    <button @click="open = false" aria-label="Tutup Modal" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold">Daftar Buku yang Dikembalikan</h2>
                        <a href="{{ route('admin.export.kembali') }}" class="text-sm bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700">
                            Export to PDF
                        </a>
                    </div>

                    @if($dataDikembalikan->isEmpty())
                    <p class="text-center text-gray-500 py-8">Data belum ada.</p>
                    @else
                    <div class="overflow-x-auto max-h-[400px] overflow-y-auto">
                        <table class="w-full text-left border text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-2 border">No</th>
                                    <th class="px-3 py-2 border">Nama Peminjam</th>
                                    <th class="px-3 py-2 border">Judul Buku</th>
                                    <th class="px-3 py-2 border">Tgl Pinjam</th>
                                    <th class="px-3 py-2 border">Tgl Kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataDikembalikan as $index => $item)
                                <tr>
                                    <td class="px-3 py-2 border">{{ $index + 1 }}</td>
                                    <td class="px-3 py-2 border">{{ $item->user->nama ?? '-' }}</td>
                                    <td class="px-3 py-2 border">{{ $item->buku->judul ?? '-' }}</td>
                                    <td class="px-3 py-2 border">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                                    <td class="px-3 py-2 border">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Kontainer 3-Kolom -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">

        <!-- Kolom Kiri (2 Kolom) -->
        <div class="md:col-span-2 space-y-6 flex flex-col">

            <!-- Buku Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-indigo-700">
                    <i data-lucide="library" class="w-5 h-5"></i> Buku Terbaru
                </h2>
                @if($bukuTerbaru->isEmpty())
                <p class="text-gray-500">Belum ada buku terbaru.</p>
                @else
                <ul class="space-y-3 overflow-y-auto max-h-[240px]">
                    @foreach($bukuTerbaru as $buku)
                    <li class="border-b pb-2 flex items-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4 text-gray-600"></i>
                        <a href="{{ route('bukus.index', $buku->id) }}" class="text-blue-500 hover:underline">
                            {{ $buku->judul }}
                        </a>
                        <span class="text-sm text-gray-500">– {{ $buku->penulis }}</span>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>

            <!-- Peminjaman Aktif -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-orange-600">
                    <i data-lucide="refresh-cw" class="w-5 h-5"></i> Peminjaman Aktif
                </h2>
                @if($PinjamAktif->isEmpty())
                <p class="text-gray-500">Belum ada peminjaman aktif.</p>
                @else
                <ul class="space-y-3 overflow-y-auto max-h-[240px]">
                    @foreach($PinjamAktif as $Pinjam)
                    <li class="border-b pb-2 flex flex-wrap items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-600"></i>
                        <span class="font-semibold">{{ $Pinjam->user->nama }}</span> -
                        <span>{{ $Pinjam->buku->judul }}</span>
                        <span class="text-sm text-gray-600">
                            ({{ $Pinjam->tgl_pinjam }} - {{ $Pinjam->tgl_kembali }})
                        </span>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <!-- Kolom Login Log -->
        <div class="bg-white p-6 rounded-lg shadow flex flex-col">
            <h2 class="text-lg font-semibold mb-3 flex items-center gap-2 text-blue-600">
                <i data-lucide="user-check" class="w-5 h-5"></i> Login Log Hari Ini
            </h2>
            @if($loginHariIni->isEmpty())
            <p class="text-gray-500 flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 text-gray-400"></i> Belum ada login hari ini.
            </p>
            @else
            <ul class="space-y-3 overflow-y-auto max-h-[400px] p-1">
                @foreach($loginHariIni as $log)
                <li class="border-b pb-2 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-sm">
                        <i data-lucide="clock" class="w-4 h-4 text-gray-600"></i>
                        <span class="font-semibold">{{ $log->login_at->format('H:i') }} WIB</span>
                    </div>
                    <div class="flex-1 flex flex-col md:flex-row md:items-center gap-2 text-sm text-gray-700">
                        <span class="font-semibold">{{ $log->user->nama }}</span>
                        <span class="text-gray-500 break-all">({{ $log->user->email }})</span>
                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>
@endsection