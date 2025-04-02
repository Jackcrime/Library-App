@extends('layouts.app')

@section('content')
<div class="p-6">
    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card Total Buku -->
        <a href="{{ route ('bukus.index') }}" class="bg-white p-6 rounded-lg shadow flex items-center gap-3 hover:bg-gray-100 transition">
            <i data-lucide="book" class="w-6 h-6 text-blue-600"></i>
            <div>
                <h2 class="text-lg font-semibold">Total Buku</h2>
                <p class="text-2xl font-bold text-blue-600">{{ $totalBuku }}</p>
            </div>
        </a>

        <!-- Card Anggota Terdaftar -->
        <a href="{{ route ('users.index') }}" class="bg-white p-6 rounded-lg shadow flex items-center gap-3 hover:bg-gray-100 transition">
            <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
            <div>
                <h2 class="text-lg font-semibold">Anggota Terdaftar</h2>
                <p class="text-2xl font-bold text-green-600">{{ $totalUser }}</p>
            </div>
        </a>

        <!-- Card Kategori Aktif -->
        <a href="{{ route ('kategoris.index') }}" class="bg-white p-6 rounded-lg shadow flex items-center gap-3 hover:bg-gray-100 transition">
            <i data-lucide="tags" class="w-6 h-6 text-purple-600"></i>
            <div>
                <h2 class="text-lg font-semibold">Kategori Aktif</h2>
                <p class="text-2xl font-bold text-purple-600">{{ $totalKategori }}</p>
            </div>
        </a>

        <!-- Card Buku yang Dikembalikan -->
        <div class="bg-white p-6 rounded-lg shadow flex items-center gap-3">
            <i data-lucide="check-circle" class="w-6 h-6 text-red-600"></i>
            <div>
                <h2 class="text-lg font-semibold">Buku yang Dikembalikan</h2>
                <p class="text-2xl font-bold text-red-600">{{ $totalDikembalikan }}</p>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Kolom Kiri: Buku Terbaru & Peminjaman Aktif -->
        <div class="md:col-span-2 space-y-6 flex flex-col overflow-y-auto">
            <!-- Buku Terbaru -->
            <div class="bg-white p-6 rounded-lg shadow max-h-60 flex flex-col">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <i data-lucide="library" class="w-5 h-5 text-indigo-600"></i>
                    Buku Terbaru
                </h2>
                <ul class="space-y-3 overflow-y-auto flex-1 p-2 mt-2">
                    @foreach($bukuTerbaru as $buku)
                    <li class="border-b pb-2 flex items-center gap-2">
                        <i data-lucide="book-open" class="w-4 h-4 text-gray-600"></i>
                        <a href="{{ route('bukus.index', $buku->id) }}" class="text-blue-500 hover:underline">
                            {{ $buku->judul }}
                        </a> - {{ $buku->penulis }}
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Peminjaman Aktif (Tinggi menyesuaikan dengan Login Log) -->
            <div class="bg-white p-6 rounded-lg shadow max-h-96 flex flex-col">
                <h2 class="text-lg font-semibold flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-5 h-5 text-orange-600"></i>
                    Peminjaman Aktif
                </h2>
                <ul class="space-y-3 overflow-y-auto flex-1 p-2 mt-2">
                    @foreach($PinjamAktif as $Pinjam)
                    <li class="border-b pb-2 flex items-center gap-2">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-600"></i>
                        <span class="font-semibold">{{ $Pinjam->user->nama }}</span> -
                        <span>{{ $Pinjam->buku->judul }}</span>
                        <span class="text-sm text-gray-600">
                            ({{ $Pinjam->tgl_pinjam }} - {{ $Pinjam->tgl_kembali }})
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Login Log-->
        <div class="bg-white p-6 rounded-lg shadow md:row-span-2 max-h-96 flex flex-col">
            <h2 class="text-lg font-semibold flex items-center gap-2">
                <i data-lucide="user-check" class="w-5 h-5 text-blue-600"></i>
                Login Log Hari Ini
            </h2>
            <ul class="space-y-3 overflow-y-auto flex-1 p-2 mt-2">
                @forelse($loginHariIni as $log)
                <li class="border-b pb-2 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-gray-600"></i>
                        <span class="text-sm font-semibold">{{ $log->login_at->format('H:i') }} WIB</span>
                    </div>
                    <div class="flex-1 flex items-center gap-2">
                        <span class="font-semibold">{{ $log->user->nama }}</span>
                        <span class="text-sm text-gray-600 break-all">
                            ({{ $log->user->email }})
                        </span>
                    </div>
                </li>
                @empty
                <li class="text-gray-500 flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-4 h-4 text-gray-400"></i>
                    Belum ada yang login hari ini.
                </li>
                @endforelse
            </ul>
        </div>

    </div>
</div>

<script>
    lucide.createIcons(); // Pastikan Lucide Icons ter-load
</script>
@endsection