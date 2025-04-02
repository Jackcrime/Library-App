<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Pinjam;
use App\Models\LoginLog;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $loginHariIni = LoginLog::whereDate('login_at', Carbon::today())
            ->with('user') 
            ->orderBy('login_at', 'desc') 
            ->take(5)
            ->get()
            ->map(function ($log) {
                $log->login_at = Carbon::parse($log->login_at); 
                return $log;
            });

        return view('admin.index', [
            'totalBuku' => Buku::count(),
            'totalUser' => User::count(),
            'totalKategori' => Kategori::count(),
            'totalDikembalikan' => Pinjam::where('status', 'Kembali')->count(),
            'bukuTerbaru' => Buku::orderBy('id', 'desc')->take(5)->get(),
            'PinjamAktif' => Pinjam::where('status', 'Pinjam')->latest()->take(5)->get(),
            'loginHariIni' => $loginHariIni 
        ]);
    }
}
