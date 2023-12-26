<!-- resources/views/admin/posts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    <a href="{{ route('admin.posts.create') }}">Create New Post</a>

    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">{{ $post->title }}</a>
                <!-- You can add more details here if needed -->
            </li>
        @endforeach
    </ul>
@endsection