<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequestStore;
use App\Http\Requests\PostRequestUpdate;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Date;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = Post::all();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequestStore $request)
    {
        $publishedAt = $request->published_at;

        if ($request->is_published && !$publishedAt) {
            $publishedAt = now();
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'is_published' => $request->is_published ? 1 : 0,
            'published_at' => $publishedAt,
        ]);

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

//        dd( $data );

        // Логика публикации
        if (
            isset($data['is_published']) &&
            $data['is_published'] &&
            empty($data['published_at']) &&
            !$post->published_at
        ) {
            $data['published_at'] = now();
        }

        $post->update($data);

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
