<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PostController extends Controller
{
    // GET /posts  -> daftar + pencarian + pagination
    public function index(Request $request): View
    {
        $posts = Post::query()
            ->search($request->query('q'))
            ->latest()
            ->paginate(6)
            ->withQueryString(); // keyword pencarian tidak hilang saat pindah halaman

        return view('posts.index', compact('posts'));
    }

    // GET /posts/create -> form tambah
    public function create(): View
    {
        return view('posts.create');
    }

    // POST /posts -> validasi (PostRequest) + simpan + flash
    public function store(PostRequest $request): RedirectResponse
    {
        try {
            $data = $request->safe()->except('image');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('posts', 'public');
            }

            $post = Post::create($data);
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'Gagal menyimpan post. Silakan coba lagi.');
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post berhasil dibuat.');
    }

    // GET /posts/{post} -> Route Model Binding: $post otomatis diambil dari database (404 jika tidak ada)
    public function show(Post $post): View
    {
        return view('posts.show', compact('post'));
    }

    // GET /posts/{post}/edit -> form edit (pre-filled)
    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    // PUT /posts/{post} -> validasi + update + flash
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        try {
            $data = $request->safe()->except('image');

            if ($request->hasFile('image')) {
                $newPath = $request->file('image')->store('posts', 'public');

                if ($post->image) {
                    Storage::disk('public')->delete($post->image); // hapus gambar lama
                }

                $data['image'] = $newPath;
            }

            $post->update($data);
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'Gagal memperbarui post. Silakan coba lagi.');
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post berhasil diperbarui.');
    }

    // DELETE /posts/{post} -> soft delete (data masih ada di tabel, kolom deleted_at terisi)
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post dipindahkan ke sampah.');
    }

    // ---------------- BONUS: soft delete ----------------

    // GET /posts/trash
    public function trash(): View
    {
        $posts = Post::onlyTrashed()->latest('deleted_at')->paginate(6);

        return view('posts.trash', compact('posts'));
    }

    // PATCH /posts/{post}/restore
    public function restore(Post $post): RedirectResponse
    {
        $post->restore();

        return redirect()->route('posts.trash')->with('success', 'Post berhasil dipulihkan.');
    }

    // DELETE /posts/{post}/force
    public function forceDelete(Post $post): RedirectResponse
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->forceDelete();

        return redirect()->route('posts.trash')->with('success', 'Post dihapus permanen.');
    }
}
