<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Fiksi', 'deskripsi' => 'Buku yang berisi cerita rekaan atau imajinatif.'],
            ['nama' => 'Non-Fiksi', 'deskripsi' => 'Buku berdasarkan fakta dan informasi nyata.'],
            ['nama' => 'Biografi & Autobiografi', 'deskripsi' => 'Buku yang menceritakan kehidupan seseorang.'],
            ['nama' => 'Ensiklopedia', 'deskripsi' => 'Buku referensi dengan informasi luas dari berbagai bidang.'],
            ['nama' => 'Kamus & Tesaurus', 'deskripsi' => 'Buku yang berisi definisi dan sinonim kata.'],
            ['nama' => 'Buku Panduan', 'deskripsi' => 'Buku berisi petunjuk atau cara melakukan sesuatu.'],
            ['nama' => 'Buku Akademik & Pendidikan', 'deskripsi' => 'Buku yang digunakan untuk pembelajaran di sekolah atau universitas.'],
            ['nama' => 'Jurnal & Artikel Ilmiah', 'deskripsi' => 'Publikasi berisi penelitian dan kajian ilmiah.'],
            ['nama' => 'Buku Agama & Spiritual', 'deskripsi' => 'Buku tentang ajaran agama dan refleksi spiritual.'],
            ['nama' => 'Buku Referensi', 'deskripsi' => 'Buku yang digunakan sebagai sumber rujukan, seperti atlas dan statistik.'],
            ['nama' => 'Buku Sejarah', 'deskripsi' => 'Buku yang membahas peristiwa sejarah dan perkembangan dunia.'],
            ['nama' => 'Buku Psikologi & Pengembangan Diri', 'deskripsi' => 'Buku yang membahas ilmu psikologi dan motivasi diri.'],
            ['nama' => 'Buku Bisnis & Ekonomi', 'deskripsi' => 'Buku tentang manajemen, investasi, dan ekonomi.'],
            ['nama' => 'Buku Teknologi & Ilmu Pengetahuan', 'deskripsi' => 'Buku yang membahas perkembangan teknologi dan sains.'],
            ['nama' => 'Buku Kesehatan & Medis', 'deskripsi' => 'Buku yang berisi informasi kesehatan dan dunia medis.'],
            ['nama' => 'Buku Hukum & Politik', 'deskripsi' => 'Buku yang membahas hukum, undang-undang, dan politik.'],
            ['nama' => 'Buku Seni & Desain', 'deskripsi' => 'Buku tentang seni rupa, musik, dan desain grafis.'],
            ['nama' => 'Buku Kuliner & Resep', 'deskripsi' => 'Buku berisi resep makanan dan minuman.'],
            ['nama' => 'Buku Perjalanan & Geografi', 'deskripsi' => 'Buku tentang wisata, peta, dan geografi.'],
            ['nama' => 'Buku Anak & Pendidikan Anak', 'deskripsi' => 'Buku yang dirancang untuk anak-anak dengan cerita atau edukasi.'],
        ];

        // Masukkan ke database
        foreach ($kategoris as $kategori) {
            DB::table('kategoris')->insert([
                'nama' => $kategori['nama'],
                'deskripsi' => $kategori['deskripsi'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
