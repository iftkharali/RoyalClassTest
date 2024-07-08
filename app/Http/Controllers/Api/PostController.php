<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        if (Gate::allows('manage-posts')) {
            $posts = Post::all(); // Fetch all posts for admins
        } else {
            $posts = Auth::user()->posts; // Fetch only user's posts for regular users
        }

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        $post = post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'is_flagged' => $request->is_flagged,
            'is_approved' => $request->is_approved ?? 0
        ]);

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        if (Gate::denies('manage-user-posts', $post)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($post);
    }

    public function update(Request $request, Post $post)
    {
        if (Gate::denies('manage-user-posts', $post)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
        ]);

        $post->update($request->only(['title', 'content']));

        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        if (Gate::denies('manage-user-posts', $post)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
