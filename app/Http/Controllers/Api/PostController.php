<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $orderColumn = request('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'title', 'created_at'])) {
            $orderColumn = 'created_at';
        }

        $orderDirection = request('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        $posts = Post::with('category')
                    ->when(request('category'), function ($query) {
                        $query->where('category_id', \request('category'));
                    })
                    ->orderBy($orderColumn, $orderDirection)
                    ->paginate(10);

        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request, Post $post)
    {
        $post = Post::create($request->validated());

        if ($request->hasFile('thumbnail')) {
            if ($request->file('thumbnail')->isValid()) {
                $file = $request->file('thumbnail');
                $filePath = $file->store('media/thumbnails', 'public');
                $post->update([
                    'thumbnail' => $filePath
                ]);
            }
        }

        return new PostResource($post);
    }
}
