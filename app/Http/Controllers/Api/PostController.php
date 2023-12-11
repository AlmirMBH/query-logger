<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $post = Post::create($request->all());

        return response()->json($post, 201);
    }

    public function index(): JsonResponse
    {
        $posts = Post::all();

        return response()->json($posts, 200);
    }

    public function show(int $id): JsonResponse
    {
        $post = Post::findOrFail($id);

        return response()->json($post, 200);
    }

    public function update(Request $request, Post $post): JsonResponse
    {
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function delete(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(null, 204);
    }
}
