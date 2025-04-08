<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes; // Corrected SoftDeletes

    protected $table = 'bukus';
    
    protected $fillable = [
        'kategori_id', 
        'judul', 
        'penulis', 
        'penerbit', 
        'isbn', 
        'tahun', 
        'jumlah', 
        'foto', 
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function pinjams()
    {
        return $this->hasMany(Pinjam::class, 'buku_id');
    }

    // Relationship for favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'buku_id');
    }

    // Relationship for bookmarks
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'buku_id');
    }
}