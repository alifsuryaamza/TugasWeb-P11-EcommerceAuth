<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->user()->posts()->create($this->validated($request));

        return redirect()->route('posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $post->update($this->validated($request));

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
        ]);
    }
}