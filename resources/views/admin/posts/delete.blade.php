<!-- resources/views/admin/posts/delete.blade.php -->
<h1>Delete Post</h1>

<p>Are you sure you want to delete the post "{{ $post->title }}"?</p>

<form method="POST" action="{{ route('posts.destroy', $post) }}">
    @csrf
    @method('DELETE')

    <button type="submit">Delete</button>
</form>
