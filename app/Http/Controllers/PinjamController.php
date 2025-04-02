<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjam;
use App\Models\Buku;
use App\Models\User;

class PinjamController extends Controller
{
    /**
     * Menampilkan daftar peminjaman.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', session('perPage', 10));
    
        session(['perPage' => $perPage]);

        $pinjams = Pinjam::with(['buku', 'user'])
        ->where(function ($query) use ($search) {
            $query->where('user_id', 'like', '%' . $search . '%')
                ->orWhere('buku_id', 'like', '%' . $search . '%');
        })
        ->withTrashed()
        ->paginate($perPage)
        ->appends([
            'search' => $search,
            'perPage' => $perPage
        ]);;
        return view('admin.pinjams.index', compact('pinjams', 'search', 'perPage'));
    }

    /**
     * Menampilkan form tambah peminjaman.
     */
    public function create()
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('admin.pinjams.create', compact('bukus', 'users'));
    }

    /**
     * Menyimpan data peminjaman baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'user_id' => 'required|exists:users,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'status' => 'required|in:pinjam,kembali',
        ]);

        Pinjam::create($request->all());

        return redirect()->route('pinjams.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail peminjaman tertentu.
     */
    public function show(Pinjam $pinjam)
    {
        return view('admin.pinjams.show', compact('pinjam'));
    }

    /**
     * Menampilkan form edit peminjaman.
     */
    public function edit(Pinjam $pinjam)
    {
        $bukus = Buku::all();
        $users = User::all();
        return view('admin.pinjams.edit', compact('pinjam', 'bukus', 'users'));
    }

    /**
     * Memperbarui data peminjaman.
     */
    public function update(Request $request, Pinjam $pinjam)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'user_id' => 'required|exists:users,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after:tgl_pinjam',
            'status' => 'required|in:pinjam,kembali',
        ]);

        $pinjam->update($request->all());

        return redirect()->route('pinjams.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    /**
     * Menghapus peminjaman (Soft Delete).
     */
    public function destroy($id)
    {
        $pinjam = Pinjam::findOrFail($id);
        $pinjam->delete(); // Soft delete
        
        return redirect()->route('pinjams.index')->with('success', 'Data berhasil dihapus sementara.');
    }

    // Restore (mengembalikan data yang terhapus)
    public function restore($id)
    {
        $pinjam = Pinjam::onlyTrashed()->findOrFail($id); // Cek hanya yang terhapus
        $pinjam->restore(); // Kembalikan data

        return redirect()->route('pinjams.index')->with('success', 'Data berhasil dikembalikan.');
    }

    // Force Delete (menghapus permanen)
    public function forceDelete($id)
    {
        $pinjam = Pinjam::onlyTrashed()->findOrFail($id); // Cek hanya yang terhapus
        $pinjam->forceDelete(); // Hapus permanen

        return redirect()->route('pinjams.index')->with('success', 'Data berhasil dihapus permanen.');
    }
}
