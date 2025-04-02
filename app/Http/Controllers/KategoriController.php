<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $perPage = $request->input('perPage', session('perPage', 10));
    
        session(['perPage' => $perPage]);
    
        $kategoris = Kategori::withTrashed()
            ->where('nama', 'like', '%' . $search . '%')
            ->paginate($perPage)
            ->appends(['search' => $search, 'perPage' => $perPage]); 
    
        return view('admin.kategoris.index', compact('kategoris', 'search', 'perPage'));
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function create()
    {
        return view('admin.kategoris.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail kategori tertentu.
     */


    /**
     * Menampilkan form edit kategori.
     */
    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    /**
     * Memperbarui data kategori.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori (Soft Delete).
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Mengembalikan kategori yang terhapus (Restore).
     */
    public function restore($id)
    {
        Kategori::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dikembalikan.');
    }

    /**
     * Menghapus permanen kategori (Force Delete).
     */
    public function forceDelete($id)
    {
        Kategori::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('kategoris.index')->with('success', 'Kategori dihapus secara permanen.');
    }
}
