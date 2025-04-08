<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function preview()
    {
        return view('preview');
    }


    public function about()
    {
        return view('guest.about');
    }

    public function contact()
    {
        return view('guest.contact');
    }
    
    public function privacy()
    {
        return view('guest.privacy');
    }

    public function support()
    {
        return view('guest.support');
    }

    public function books(Request $request)
{
    $kategoris = Kategori::all();
    $bukuPopuler = Buku::withCount('pinjams')->orderByDesc('pinjams_count')->limit(6)->get();
    $bukuBaru = Buku::orderByDesc('created_at')->limit(6)->get();
    $searchQuery = $request->get('query');
    $categoryId = $request->get('kategori'); // gunakan nama parameter 'kategori' sesuai dari fetch()
    $books = Buku::query();

    if ($searchQuery) {
        $books->where('judul', 'like', '%' . $searchQuery . '%');
    }

    if ($categoryId) {
        $books->where('kategori_id', $categoryId);
    }

    $books = $books->get();

    if ($request->ajax()) {
        return view('guest.partials.book_list', compact('books'))->render();
    }

    return view('guest.books', compact('kategoris', 'bukuPopuler', 'bukuBaru', 'books'));
}

    public function allBooks()
    {
        $books = Buku::all(); // Retrieve all books
        return view('book.all_books', compact('books')); // Return the view with all books
    }

    public function status($id)
    {
        $user = auth()->user();

        $isFavorited = $user->favorites()->where('book_id', $id)->exists();
        $isBookmarked = $user->bookmarks()->where('book_id', $id)->exists();

        return response()->json([
            'isFavorited' => $isFavorited,
            'isBookmarked' => $isBookmarked,
        ]);
    }

    public function pinjamBuku(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
        ]);

        $cekPinjam = Pinjam::where('user_id', Auth::id())
            ->where('buku_id', $request->buku_id)
            ->where('status', 'pinjam')
            ->first();

        if ($cekPinjam) {
            return redirect()->back()->with('error', 'Kamu sudah meminjam buku ini!');
        }

        Pinjam::create([
            'buku_id' => $request->buku_id,
            'user_id' => Auth::id(),
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'pinjam',
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dipinjam!');
    }


    public function history()
    {
        $borrows = Pinjam::with('buku', 'pengembalian') 
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    
        $active = $borrows->filter(function ($item) {
            return $item->status === 'pinjam' || is_null($item->tgl_kembali);
        });
    
        return view('guest.book.history', compact('borrows', 'active'));
    }
    


    public function edit()
    {
        return view('guest.profile');
    }

    public function update(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to update your profile.');
        }

        $user = Auth::user();
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('foto')) {
            // Handle the file upload
            $path = $request->file('foto')->store('profile_pictures', 'public');
            $data['foto'] = $path;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function deletePhoto()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to delete your profile picture.');
        }

        $user = Auth::user();

        // Delete the old photo if it exists
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        // Set the user's photo to the default image
        $user->foto = null; // or you can set it to a default path if you have one
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile picture deleted successfully.');
    }
}
