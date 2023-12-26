<!-- resources/views/admin/posts/form.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Create/Edit Post</h1>

    <form action="{{ isset($post) ? route('admin.posts.update', ['post' => $post->id]) : route('admin.posts.store') }}" method="POST">
        @csrf
        @if(isset($post))
            @method('PUT')
        @endif

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{
            isset($post) ? $post->title : old('title') }}">
            @error('title')
                <div>{{ $message }}</div>
            @enderror

            <label for="content">Content:</label>
            <textarea name="content">{{ isset($post) ? $post->content : old('content') }}</textarea>
            @error('content')
                <div>{{ $message }}</div>
            @enderror

            <label for="image">Image:</label>
            <input type="text" name="image" value="{{ isset($post) ? $post->image : old('image') }}">
            @error('image')
                <div>{{ $message }}</div>
            @enderror

            <button type="submit">Save</button>
        </form>
    @endsection