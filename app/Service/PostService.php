<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PostService
{
    public function store( array $data ) : Post
    {
        if ($data[ 'is_published' ] && !$data[ 'is_published' ]) {
            $publishedAt = now();
        }

        $post = Post::create([
            'title' => $data[ 'title' ],
            'content' => $data[ 'content' ],
            'is_published' => $data[ 'is_published' ] ? 1 : 0,
            'published_at' => $data[ 'is_published' ] ? now() : null,
        ]);

        return $post;
    }


    public function update( array $data, Post $post ) : Post
    {

        if (
            isset($data['is_published']) &&
            $data['is_published'] &&
            empty($data['published_at']) &&
            !$post->published_at
        ) {
            $data['published_at'] = now();
        }

        $post->update($data);

        return $post;
    }

    public function index( array $data ) : LengthAwarePaginator
    {
        $page = $data['page'] ?? 1;
        $perPage = $data['per_page'] ?? 3;

        $posts = Post::query()
            ->where( 'is_published', 1 )
            ->paginate( $perPage, [ '*' ], 'page', $page );

        return $posts;
    }
}
