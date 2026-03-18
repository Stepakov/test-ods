<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequestFilter;
use App\Http\Requests\PostRequestStore;
use App\Http\Requests\PostRequestUpdate;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Date;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index( PostRequestFilter $request )
    {
        $data = $request->validated();

        $posts = $this->service->index( $data );

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequestStore $request)
    {
        $data = $request->validated();

        $post = $this->service->store( $data );

        return PostResource::make( $post );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return PostResource::make( $post );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequestUpdate $request, Post $post)
    {
        $data = $request->validated();

        $post = $this->service->update( $data, $post );

        return PostResource::make($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post)
    {
        $post = Post::find( $post );

        if (!$post) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}
