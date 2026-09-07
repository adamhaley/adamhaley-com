<?php

namespace App\Http\Controllers\Api;

use App\Actions\UpsertPostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $posts = Post::query()
            ->when($request->query('source'), fn ($query, $source) => $query->where('source', $source))
            ->latest()
            ->paginate(min((int) $request->query('per_page', 25), 100));

        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request, UpsertPostAction $upsertPost)
    {
        $post = $upsertPost($request->validated());

        return (new PostResource($post))
            ->response()
            ->setStatusCode($post->wasRecentlyCreated ? 201 : 200);
    }
}
