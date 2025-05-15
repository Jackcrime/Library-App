<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Pinjam;
use App\Models\LoginLog;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
            'loginHariIni' => $loginHariIni,
            'dataDikembalikan' => Pinjam::where('status', 'Kembali')->with('buku', 'user')->latest()->take(5)->get(),
        ]);
    }

    public function exportKembaliPDF()
    {
        $dataKembali = Pinjam::where('status', 'Kembali')->with('buku', 'user')->get();
    
        $pdf = PDF::loadView('pdf.data_kembali', compact('dataKembali'))->setPaper('a4', 'portrait');
    
        return $pdf->download('data-buku-kembali.pdf');
    }    
}