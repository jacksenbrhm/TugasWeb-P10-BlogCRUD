@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">Edit Post</h1>

    @include('posts._form', [
        'action' => route('posts.update', $post),
        'method' => 'PUT',
        'post'   => $post,
        'submit' => 'Perbarui Post',
    ])
@endsection
