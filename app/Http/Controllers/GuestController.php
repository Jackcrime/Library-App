<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class GuestController extends Controller
{
    public function Preview()
    {
        return view('preview');
    }

    public function index()
    {
        return view('guest.index');
    }

    public function about()
    {
        return view('guest.about');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function books()
    {
         // Ambil semua kategori untuk ditampilkan pada filter
         $kategoris = Kategori::all();

         // Ambil Buku Populer berdasarkan peminjaman terbanyak
         $bukusPopuler = Buku::withCount('pinjams')
                             ->orderByDesc('pinjams_count') // urutkan berdasarkan jumlah peminjaman
                             ->limit(8) // Ambil 8 buku populer
                             ->get();
 
         // Ambil Buku Baru berdasarkan tanggal penambahan terbaru
         $bukusBaru = Buku::orderByDesc('created_at') // urutkan berdasarkan tanggal dibuat
                          ->limit(8) // Ambil 8 buku terbaru
                          ->get();

        $books = Buku::all(); // Ambil semua buku
 
         // Kirim data kategori, buku populer dan buku baru ke view
         return view('guest.books', compact('kategoris', 'bukusPopuler', 'bukusBaru', 'books'));
    }

    public function challenge()
    {
        return view('guest.challenge');
    }

    public function privacy()
    {
        return view('guest.privacy');
    }

    public function support()
    {
        return view('guest.support');
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

    public function deletePhoto(Request $request)
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
