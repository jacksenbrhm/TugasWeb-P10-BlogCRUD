@props(['post'])

<article {{ $attributes->merge(['class' => 'flex flex-col overflow-hidden rounded-xl bg-white shadow']) }}>
    @if ($post->image_url)
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-44 w-full object-cover">
    @else
        <div class="flex h-44 items-center justify-center bg-slate-200 text-sm text-slate-400">Tanpa gambar</div>
    @endif

    <div class="flex flex-1 flex-col p-4">
        <h3 class="text-lg font-semibold leading-snug">
            <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-600">{{ $post->title }}</a>
        </h3>
        <p class="mt-1 text-xs text-slate-500">oleh {{ $post->author }} &middot; {{ $post->created_at->format('d M Y') }}</p>
        <p class="mt-2 flex-1 text-sm text-slate-600">{{ $post->excerpt }}</p>

        @isset($footer)
            <div class="mt-4 border-t border-slate-100 pt-3">{{ $footer }}</div>
        @endisset
    </div>
</article>
