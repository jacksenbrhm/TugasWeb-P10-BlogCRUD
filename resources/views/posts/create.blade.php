@extends('layouts.app')

@section('title', 'Tulis Post')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Tulis Post Baru</h1>

    @include('posts._form', [
        'action' => route('posts.store'),
        'method' => 'POST',
        'post'   => null,
        'submit' => 'Simpan Post',
    ])
@endsection
