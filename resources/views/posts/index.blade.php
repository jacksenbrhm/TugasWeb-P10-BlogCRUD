@extends('layouts.app')

@section('title', 'Semua Post')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-2xl font-bold">Semua Post</h1>
        <a href="{{ route('posts.create') }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">+ Tulis Post</a>
    </div>

    {{-- Pencarian (GET, jadi tidak butuh @csrf) --}}
    <form action="{{ route('posts.index') }}" method="GET" class="mb-6 flex gap-2">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari judul, penulis, atau isi..."
               class="w-full rounded-lg border border-slate-300 px-3 py-2">
        <button type="submit" class="rounded-lg bg-slate-800 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Cari</button>
        @if (request('q'))
            <a href="{{ route('posts.index') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm">Reset</a>
        @endif
    </form>

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($posts as $post)
            <x-card :post="$post">
                <x-slot:footer>
                    <div class="flex items-center gap-4 text-sm">
                        <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:underline">Baca</a>
                        <a href="{{ route('posts.edit', $post) }}" class="text-amber-600 hover:underline">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                              onsubmit="return confirm('Pindahkan post ini ke sampah?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </x-slot:footer>
            </x-card>
        @empty
            <p class="col-span-full rounded-lg bg-white p-8 text-center text-slate-500 shadow">Belum ada post.</p>
        @endforelse
    </div>

    {{-- Pagination otomatis --}}
    <div class="mt-8">{{ $posts->links() }}</div>
@endsection
