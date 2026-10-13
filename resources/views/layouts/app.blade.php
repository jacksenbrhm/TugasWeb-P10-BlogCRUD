<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog') | {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="bg-indigo-600 text-white shadow">
        <nav class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-2 px-4 py-3">
            <a href="{{ route('posts.index') }}" class="text-lg font-bold">📝 {{ config('app.name') }}</a>
            <ul class="flex flex-wrap gap-4 text-sm">
                <li><a href="{{ route('posts.index') }}" class="hover:underline {{ request()->routeIs('posts.index') ? 'font-bold underline' : '' }}">Semua Post</a></li>
                <li><a href="{{ route('posts.create') }}" class="hover:underline {{ request()->routeIs('posts.create') ? 'font-bold underline' : '' }}">Tulis Post</a></li>
                <li><a href="{{ route('posts.trash') }}" class="hover:underline {{ request()->routeIs('posts.trash') ? 'font-bold underline' : '' }}">Sampah</a></li>
            </ul>
        </nav>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8">
        {{-- Flash message sukses / gagal (tampil sekali setelah redirect) --}}
        @if (session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif
        @if (session('error'))
            <x-alert type="danger">{{ session('error') }}</x-alert>
        @endif

        @yield('content')
    </main>

    <footer class="py-6 text-center text-sm text-slate-500">
        &copy; {{ date('Y') }} Tugas Rutin 10 - Blog CRUD Laravel | Pemrograman Web, UNIMED
    </footer>

</body>
</html>
