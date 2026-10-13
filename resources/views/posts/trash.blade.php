@extends('layouts.app')

@section('title', 'Sampah')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-2xl font-bold">Sampah</h1>
        <a href="{{ route('posts.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm">&larr; Kembali</a>
    </div>

    <ul class="divide-y divide-slate-200 overflow-hidden rounded-xl bg-white shadow">
        @forelse ($posts as $post)
            <li class="flex flex-wrap items-center justify-between gap-3 p-4">
                <div>
                    <p class="font-semibold">{{ $post->title }}</p>
                    <p class="text-xs text-slate-500">oleh {{ $post->author }} &middot; dihapus {{ $post->deleted_at->diffForHumans() }}</p>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <form action="{{ route('posts.restore', $post) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-indigo-600 hover:underline">Pulihkan</button>
                    </form>
                    <form action="{{ route('posts.force-delete', $post) }}" method="POST"
                          onsubmit="return confirm('Hapus permanen? Data tidak bisa dikembalikan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus Permanen</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="p-8 text-center text-slate-500">Sampah kosong.</li>
        @endforelse
    </ul>

    <div class="mt-6">{{ $posts->links() }}</div>
@endsection
