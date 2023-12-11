<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $author = Author::create($request->all());

        return response()->json($author, 201);
    }

    public function index(): JsonResponse
    {
        $authors = Author::all();

        return response()->json($authors, 200);
    }

    public function authorsWithPosts(): JsonResponse
    {
        $authors = Author::with('posts')->get();

        return response()->json($authors, 200);
    }

    public function show(int $int): JsonResponse
    {
        $author = Author::findOrFail($int);

        return response()->json($author, 200);
    }

    public function authorWithPosts(Author $author): JsonResponse
    {
        $author = $author->with('posts')->first();

        return response()->json($author, 200);
    }

    public function update(Request $request, Author $author): JsonResponse
    {
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete(Author $author): JsonResponse
    {
        $author->delete();

        return response()->json(null, 204);
    }
}
