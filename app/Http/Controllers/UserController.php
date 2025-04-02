<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function main()
    {
        return view('index');
    }

    // Menampilkan semua user dengan admin di atas dan member di bawah
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $perPage = $request->input('perPage', session('perPage', 10));
    
        session(['perPage' => $perPage]);

        $users = User::withTrashed()
            ->where('nama', 'like', '%' . $search . '%')
            ->orderByRaw("FIELD(jenis, 'admin', 'member')")
            ->paginate($perPage)
            ->appends(['search' => $search, 'perPage' => $perPage]); ;

        return view('admin.users.index', compact('users', 'search', 'perPage'));
    }


    // Menampilkan user berdasarkan ID
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jenis' => 'required|in:admin,member',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.create')->withErrors($validator)->withInput();
        }

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'jenis' => 'required|in:admin,member',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        }

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    // Menghapus user (soft delete)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

    // Mengembalikan user yang telah dihapus sementara
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index')->with('success', 'User berhasil dikembalikan');
    }

    // Menghapus user secara permanen
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus permanen');
    }
}
