@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="overflow-hidden rounded-xl bg-white shadow">
        @if ($post->image_url)
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="max-h-96 w-full object-cover">
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold">{{ $post->title }}</h1>
            <p class="mt-1 text-sm text-slate-500">oleh {{ $post->author }} &middot; {{ $post->created_at->format('d M Y, H:i') }}</p>

            {{-- e() menjaga isi tetap aman dari XSS, nl2br mempertahankan baris baru --}}
            <div class="mt-6 leading-relaxed text-slate-700">{!! nl2br(e($post->body)) !!}</div>

            <div class="mt-8 flex flex-wrap items-center gap-3 border-t border-slate-100 pt-4 text-sm">
                <a href="{{ route('posts.index') }}" class="rounded-lg border border-slate-300 px-4 py-2">&larr; Kembali</a>
                <a href="{{ route('posts.edit', $post) }}" class="rounded-lg bg-amber-500 px-4 py-2 font-semibold text-white hover:bg-amber-600">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                      onsubmit="return confirm('Pindahkan post ini ke sampah?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 font-semibold text-white hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </article>
@endsection
