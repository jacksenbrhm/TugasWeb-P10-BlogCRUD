<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            ['Memulai Belajar Laravel', 'Samuel', 'Laravel adalah framework PHP yang memakai pola MVC. Dengan Artisan dan Composer, proyek bisa dibuat hanya dalam beberapa menit.'],
            ['Mengenal Routing di Laravel', 'Samuel', 'Route menghubungkan URL dengan controller. Route::resource membuat tujuh route CRUD sekaligus dalam satu baris kode.'],
            ['Blade Templating untuk Pemula', 'Jacksen', 'Blade memungkinkan layout master dengan @extends dan @yield, serta komponen yang bisa dipakai ulang di banyak halaman.'],
            ['Validasi Form dengan Form Request', 'Jacksen', 'Form Request memindahkan aturan validasi dari controller ke class tersendiri sehingga controller menjadi lebih bersih.'],
            ['Route Model Binding Itu Praktis', 'Samuel', 'Dengan type-hint Post $post, Laravel otomatis mengambil data dari database dan menampilkan 404 jika datanya tidak ditemukan.'],
            ['Pagination Otomatis', 'Brahmana', 'Method paginate() memotong data menjadi beberapa halaman dan links() menampilkan tombol navigasinya secara otomatis.'],
            ['Upload Gambar ke Storage', 'Brahmana', 'File diunggah ke disk public lalu ditautkan lewat php artisan storage:link agar bisa diakses dari browser.'],
            ['Soft Delete di Eloquent', 'Samuel', 'Dengan trait SoftDeletes, data tidak benar-benar hilang. Kolom deleted_at terisi sehingga data bisa dipulihkan kapan saja.'],
            ['Flash Message Setelah Redirect', 'Jacksen', 'Method with() menyimpan pesan di session untuk satu kali tampil, cocok untuk notifikasi sukses atau gagal.'],
            ['Tips Belajar Pemrograman Web', 'Brahmana', 'Kerjakan proyek kecil secara rutin, baca dokumentasi resmi, dan jangan takut membaca pesan error dengan teliti.'],
        ];

        foreach ($posts as [$title, $author, $body]) {
            Post::create(['title' => $title, 'author' => $author, 'body' => $body]);
        }
    }
}
