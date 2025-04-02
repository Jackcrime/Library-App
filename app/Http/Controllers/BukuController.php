<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class BukuController extends Controller
{
    /**
     * Menampilkan daftar buku.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
        $perPage = $request->input('perPage', session('perPage', 10));
    
        session(['perPage' => $perPage]);
    
        $bukus = Buku::with('kategori')
            ->withTrashed()
            ->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('penulis', 'like', '%' . $search . '%')
                    ->orWhere('penerbit', 'like', '%' . $search . '%');
            })
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'perPage' => $perPage
            ]);
    
        return view('admin.bukus.index', compact('bukus', 'search', 'perPage'));
    }
    

    /**
     * Menampilkan form tambah buku.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.bukus.create', compact('kategoris'));
    }

    /**
     * Menyimpan buku baru ke database.
     */
    public function store(Request $request)
{
    $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'judul' => 'required|string',
        'penulis' => 'nullable|string',
        'penerbit' => 'nullable|string',
        'isbn' => 'nullable|string',
        'tahun' => 'nullable|string',
        'jumlah' => 'nullable|integer',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $path = $file->store('uploads/buku', 'public'); // Simpan di storage/app/public/uploads/buku
        $data['foto'] = $path;
    }

    
    Buku::create($data);

    return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan.');
}

    /**
     * Menampilkan detail buku tertentu.
     */
    public function show(Buku $buku)
    {

    }

    /**
     * Menampilkan form edit buku.
     */
    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();
        return view('admin.bukus.edit', compact('buku', 'kategoris'));
    }

    /**
     * Memperbarui data buku.
     */
    public function update(Request $request, Buku $buku)
{
    $request->validate([
        'kategori_id' => 'required|exists:kategoris,id',
        'judul' => 'required|string',
        'penulis' => 'nullable|string',
        'penerbit' => 'nullable|string',
        'isbn' => 'nullable|string',
        'tahun' => 'nullable|string',
        'jumlah' => 'nullable|integer',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($buku->foto) {
            Storage::disk('public')->delete($buku->foto);
        }

        $file = $request->file('foto');
        $path = $file->store('uploads/buku', 'public');
        $data['foto'] = $path;
    }

    $buku->update($data);

    return redirect()->route('bukus.index')->with('success', 'Buku berhasil diperbarui.');
}

    /**
     * Menghapus buku (Soft Delete).
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus.');
    }

    /**
     * Mengembalikan buku yang terhapus (Restore).
     */
    public function restore($id)
    {
        Buku::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dikembalikan.');
    }

    /**
     * Menghapus permanen buku (Force Delete).
     */
    public function forceDelete($id)
    {
        Buku::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('bukus.index')->with('success', 'Buku dihapus secara permanen.');
    }
}
