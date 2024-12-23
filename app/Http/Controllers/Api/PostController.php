<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
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

    public function show($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return [
                'message' => 'No post found'
            ];
        }
        return new PostResource(true, 'Data post', $post);
    }

    public function update(PostRequest $request, $id)
    {
        $validated = $request->validated();
        $post = Post::find($id);

        if (!$post) {
            return [
                'message' => 'No post found'
            ];
        }

        $post->fill($validated);
        $post->save();

        return [
            'message' => ' Post Update successfully!'
        ];
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return [
                'message' => ' Post not found!'
            ];
        }

        $post->delete();

        return [
            'message' => ' Post delete successfully!'
        ];
    }
}
