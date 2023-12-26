<?php
// app/Http/Controllers/Admin/PostController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Mail\NewPostNotification;
use App\Mail\UpdatedPostNotification;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index()
    {
        // Retrieve all posts from the database
        $posts = Post::all();

        // Pass the posts to the view for rendering
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        // Logic to display the create form
        return view('admin.posts.form');
    }

    public function store(Request $request)
    {
        // Validation logic
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'image' => 'required',
        ]);

        // Create post logic
        $post = new Post($validatedData);
        $post->save();

        // Send email notification
        Mail::to($post->author)->send(new NewPostNotification($post));

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        // Logic to display the edit form for a specific resource
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // Validation logic
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required',
            'image' => 'required',
        ]);

        // Update post logic
        $post->update($validatedData);

        // Send email notification
        Mail::to($post->author)->send(new UpdatedPostNotification($post));

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        // Logic to delete the specified resource
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}