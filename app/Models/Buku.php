<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Buku extends Model
{
    use HasFactory, Softdeletes;

    protected $table = 'bukus';
    
    protected $fillable = ['kategori_id', 'judul', 'penulis', 'penerbit', 'isbn', 'tahun', 'jumlah', 'foto', 'deskripsi'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function pinjams()
    {
        return $this->hasMany(Pinjam::class);
    }
}
