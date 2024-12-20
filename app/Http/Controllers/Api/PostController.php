<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return new PostResource(true, 'List data posts', $posts);
    }

    public function store (PostRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = auth()->id();

        Post::create($validated);

        return [
            'message' => 'Create new post successfully!'
        ];
    }
}
