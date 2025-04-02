<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Pinjam;
use App\Models\Buku;
use App\Models\User;
use App\Mail\PeringatanEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        // Get search input and items per page
        $search = $request->input('search');
        $perPage = $request->input('perPage', session('perPage', 10));
        session(['perPage' => $perPage]);

        // Fetch overdue loans that have not been returned
        $telatPinjam = Pinjam::where('status', 'pinjam')
            ->where('tgl_kembali', '<', Carbon::now())
            ->get();

        // Check if there are overdue loans
        if ($telatPinjam->isNotEmpty()) {
            foreach ($telatPinjam as $pinjam) {
                // Check if the return record already exists
                $existing = Pengembalian::where('pinjam_id', $pinjam->id)->first();

                if (!$existing) {
                    // Insert overdue loan data into the pengembalians table
                    Pengembalian::create([
                        'pinjam_id'   => $pinjam->id,
                        'user_id'     => $pinjam->user_id,
                        'buku_id'     => $pinjam->buku_id,
                        'tgl_kembali' => $pinjam->tgl_kembali,
                        'denda'       => 0,
                        'stats'       => 'Belum Lunas',
                    ]);
                }
            }
        }

        // Fetch paginated loan data with related books and users
        $pengembalians = Pengembalian::with(['buku', 'user'])
        ->where('stats', '!=', 'Lunas')
        ->where(function ($query) use ($search) {
            $query->whereHas('user', fn($q) => $q->where('nama', 'like', "%$search%"))
                  ->orWhereHas('buku', fn($q) => $q->where('judul', 'like', "%$search%"));
        })
        ->paginate($perPage)
        ->appends(compact('search', 'perPage'));
    

        // Return the view with the data
        return view('admin.pengembalians.index', compact('pengembalians', 'search', 'perPage'));
    }

    public function peringatan($id, $peringatan)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        if ($pengembalian->stats === 'Lunas') {
            return back()->with('error', "Buku ini sudah lunas, tidak bisa diberi peringatan.");
        }

        $user = $pengembalian->user;
        $tgl_kembali = Carbon::parse($pengembalian->tgl_kembali);
        $hari_terlambat = (int) $tgl_kembali->diffInDays(Carbon::now(), false);

        // Hitung denda berdasarkan peringatan
        $denda = match ($peringatan) {
            1 => 10000,
            2 => 20000,
            3 => 40000,
            default => 10000,
        };

        // Update denda di database
        $pengembalian->update(['denda' => $denda]);

        // Kirim Email Peringatan ke User
        Mail::to($user->email)->send(new PeringatanEmail($user, $denda, $peringatan));

        return back()->with('success', "Peringatan $peringatan dikirim ke {$user->nama}. Denda: Rp" . number_format($denda, 0, ',', '.'));
    }

    public function lunas($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update(['stats' => 'Lunas']);

        // Tambahkan jumlah buku kembali ke tabel bukus
        Buku::where('id', $pengembalian->buku_id)->increment('jumlah', 1);

        // Update status pinjaman menjadi kembali
        Pinjam::where('id', $pengembalian->pinjam_id)->update(['status' => 'Kembali']);

        // Data akan otomatis dihapus setelah 30 hari jika telat atau 14 hari jika tepat waktu
        $deleteDays = ($pengembalian->denda > 0) ? 30 : 14;
        $pengembalian->delete();

        return back()->with('success', "Status Lunas. Data akan dihapus dalam $deleteDays hari.");
    }
}

