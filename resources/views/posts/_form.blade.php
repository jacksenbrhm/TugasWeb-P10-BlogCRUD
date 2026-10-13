{{-- Variabel: $action, $method (POST|PUT), $post (null saat create), $submit --}}
@if ($errors->any())
    <x-alert type="danger">Periksa kembali form! Ada {{ $errors->count() }} kesalahan input.</x-alert>
@endif

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-xl bg-white p-6 shadow" novalidate>
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label for="title" class="mb-1 block text-sm font-semibold">Judul</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post?->title) }}"
               class="w-full rounded-lg border px-3 py-2 @error('title') border-red-500 @else border-slate-300 @enderror">
        @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="author" class="mb-1 block text-sm font-semibold">Penulis</label>
        <input type="text" id="author" name="author" value="{{ old('author', $post?->author) }}"
               class="w-full rounded-lg border px-3 py-2 @error('author') border-red-500 @else border-slate-300 @enderror">
        @error('author')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="body" class="mb-1 block text-sm font-semibold">Isi Post</label>
        <textarea id="body" name="body" rows="8"
                  class="w-full rounded-lg border px-3 py-2 @error('body') border-red-500 @else border-slate-300 @enderror">{{ old('body', $post?->body) }}</textarea>
        @error('body')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="mb-1 block text-sm font-semibold">Gambar (opsional, maks. 2 MB)</label>
        @if ($post?->image_url)
            <img src="{{ $post->image_url }}" alt="Gambar saat ini" class="mb-2 h-32 rounded-lg object-cover">
        @endif
        <input type="file" id="image" name="image" accept="image/*" class="block w-full text-sm">
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-3">
        <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-700">{{ $submit }}</button>
        <a href="{{ route('posts.index') }}" class="rounded-lg border border-slate-300 px-5 py-2 text-sm">Batal</a>
    </div>
</form>
