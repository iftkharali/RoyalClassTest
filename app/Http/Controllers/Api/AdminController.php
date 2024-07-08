<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function listPosts()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function destroyPost(Post $post)
    {
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
