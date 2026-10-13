<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Halaman utama diarahkan ke daftar post
Route::redirect('/', '/posts');

// BONUS (soft delete): route tambahan HARUS dideklarasikan sebelum resource,
// supaya "/posts/trash" tidak dianggap sebagai {post}.
Route::get('posts/trash', [PostController::class, 'trash'])->name('posts.trash');
Route::patch('posts/{post}/restore', [PostController::class, 'restore'])
    ->withTrashed()->name('posts.restore');
Route::delete('posts/{post}/force', [PostController::class, 'forceDelete'])
    ->withTrashed()->name('posts.force-delete');

// 7 route CRUD sekaligus + named routes (posts.index, posts.create, posts.store,
// posts.show, posts.edit, posts.update, posts.destroy)
Route::resource('posts', PostController::class);
