<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengembalian extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['pinjam_id', 'user_id', 'buku_id', 'tgl_kembali', 'denda', 'status, stats'];

    public function pinjam()
    {
        return $this->belongsTo(Pinjam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
