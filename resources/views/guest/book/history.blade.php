@extends('layouts.nav')

@section('contents')
<div class="p-10 space-y-10" x-data="{ modalaktif: null, modal: null }" @keydown.escape.window="modalaktif = null; modal = null">
    <h1 class="text-3xl font-bold text-gray-800 my-4">
    <i class="fas fa-book text-blue-600 text-2xl"></i>
    Riwayat Peminjaman</h1>

    {{-- Pinjaman Aktif --}}
    @if($active->count())
    <section>
        <h2 class="text-xl font-semibold text-green-700 mb-3">Pinjaman Aktif</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($active as $borrow)
            <div class="group relative bg-white border border-green-100 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <img src="{{ asset('storage/' . $borrow->buku->foto) }}" alt="Cover" class="w-full h-48 object-cover">
                <span class="absolute top-0 left-0 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-br-xl">Active</span>

                <div class="p-4 space-y-2">
                    <h3 class="text-lg font-bold text-gray-800">{{ $borrow->buku->judul }}</h3>
                    <p class="text-sm text-gray-600">Kembalikan sebelum: <span class="text-red-500 font-medium">{{ \Carbon\Carbon::parse($borrow->tgl_kembali)->format('d M Y') }}</span></p>
                    <button @click="modalaktif = {{ $borrow->id }}" class="text-sm font-medium text-blue-600 hover:underline hover:text-blue-800 transition">📖 Preview Buku</button>
                </div>
            </div>

            {{-- Modal Preview Pinjaman Aktif --}}
            <template x-if="modalaktif === {{ $borrow->id }}">
                <div x-cloak class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
                    <div x-show="true" x-transition.duration.300ms class="bg-white rounded-2xl w-full max-w-xl relative shadow-xl">
                        <button @click="modalaktif = null" class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-3xl font-bold">&times;</button>
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold mb-3">{{ $borrow->buku->judul }}</h2>
                            <img src="{{ asset('storage/' . $borrow->buku->foto) }}" class="w-full h-52 object-cover rounded-lg shadow mb-4">
                            <ul class="space-y-1 text-sm text-gray-700">
                                <li><strong>Dipinjam:</strong> {{ \Carbon\Carbon::parse($borrow->tgl_pinjam)->format('d M Y') }}</li>
                                <li><strong>Kembali:</strong> {{ \Carbon\Carbon::parse($borrow->tgl_kembali)->format('d M Y') }}</li>
                                <li><strong>Status:</strong> <span class="text-green-600 font-semibold capitalize">{{ $borrow->status }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </template>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Semua Riwayat --}}
    <section>
        <h2 class="text-xl font-semibold text-gray-800 mb-3">📖 Semua Riwayat</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @forelse ($borrows as $borrow)
            <div class="relative bg-white rounded-xl border border-gray-200 shadow-md group hover:shadow-xl transition duration-300">
                <img src="{{ asset('storage/' . $borrow->buku->foto) }}" alt="Cover" class="w-full h-48 object-cover">
                <div class="p-4 space-y-2">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $borrow->buku->judul }}</h3>
                    <p class="text-sm text-gray-600">Dipinjam: {{ \Carbon\Carbon::parse($borrow->tgl_pinjam)->format('d M Y') }}</p>
                    <p class="text-sm font-medium text-gray-700">Status: 
                        <span class="{{ $borrow->status === 'aktif' ? 'text-green-600' : 'text-gray-500' }}">
                            {{ ucfirst($borrow->status) }}
                        </span>
                    </p>
                    @if ($borrow->pengembalian)
                    <div class="bg-gray-50 border border-gray-100 p-3 rounded-md text-sm text-gray-700">
                        <p><strong>Kembali:</strong> {{ \Carbon\Carbon::parse($borrow->pengembalian->tgl_kembali)->format('d M Y') }}</p>
                        <p><strong>Denda:</strong> 
                            <span class="{{ $borrow->pengembalian->denda > 0 ? 'text-red-600 font-semibold' : 'text-green-600' }}">
                                Rp {{ number_format($borrow->pengembalian->denda, 0, ',', '.') }}
                            </span>
                        </p>
                        <p><strong>Status Denda:</strong> 
                            <span class="{{ $borrow->pengembalian->stats === 'Belum Lunas' ? 'text-red-500 font-semibold' : 'text-green-600' }}">
                                {{ $borrow->pengembalian->stats }}
                            </span>
                        </p>
                    </div>
                    @endif
                    <button @click="modal = {{ $borrow->id }}" class="block mt-2 text-blue-600 text-sm hover:underline">🔍 Preview Buku</button>
                </div>
            </div>

            {{-- Modal Preview Semua Riwayat --}}
            <template x-if="modal === {{ $borrow->id }}">
                <div x-cloak class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
                    <div x-show="true" x-transition.duration.300ms class="bg-white rounded-2xl w-full max-w-xl relative shadow-xl">
                        <button @click="modal = null" class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-3xl font-bold">&times;</button>
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold mb-3">{{ $borrow->buku->judul }}</h2>
                            <img src="{{ asset('storage/' . $borrow->buku->foto) }}" class="w-full h-52 object-cover rounded-lg shadow mb-4">
                            <ul class="space-y-1 text-sm text-gray-700">
                                <li><strong>Dipinjam:</strong> {{ \Carbon\Carbon::parse($borrow->tgl_pinjam)->format('d M Y') }}</li>
                                <li><strong>Status:</strong> <span class="capitalize {{ $borrow->status === 'aktif' ? 'text-green-600' : 'text-gray-600' }}">{{ $borrow->status }}</span></li>
                                @if ($borrow->pengembalian)
                                <hr class="my-2">
                                <li><strong>Dikembalikan:</strong> {{ \Carbon\Carbon::parse($borrow->pengembalian->tgl_kembali)->format('d M Y') }}</li>
                                <li><strong>Denda:</strong> 
                                    <span class="{{ $borrow->pengembalian->denda > 0 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                        Rp {{ number_format($borrow->pengembalian->denda, 0, ',', '.') }}
                                    </span>
                                </li>
                                <li><strong>Status Denda:</strong> 
                                    <span class="{{ $borrow->pengembalian->stats === 'Belum Lunas' ? 'text-red-500 font-semibold' : 'text-green-600' }}">
                                        {{ $borrow->pengembalian->stats }}
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </template>
            @empty
            <p class="text-gray-500">Belum ada riwayat peminjaman.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
