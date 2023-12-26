<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPostNotification;
use App\Mail\UpdatedPostNotification;

class PostController extends Controller
{
  // Other methods...

  public function store(Request $request) {
    $validatedData = $request->validate([
        'title' => 'required|max:100',
        'content' => 'required',
        'image' => 'required',
    ]);

    // Create post logic (e.g., save to the database)
    $post = Post::create($validatedData);

    // Send email notification
    Mail::to($post->author)->send(new NewPostNotification($post));
}

public function update(Request $request, Post $post) {
    $validatedData = $request->validate([
        'title' => 'required|max:100',
        'content' => 'required',
        'image' => 'required',
    ]);

    // Update post logic (e.g., update in the database)
    $post->update($validatedData);

    // Send email notification
    Mail::to($post->author)->send(new UpdatedPostNotification($post));
}
}
