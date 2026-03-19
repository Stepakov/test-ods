<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PostService
{
    public function store( array $data ) : Post
    {
        $isPublished = !empty($data['is_published']);

        $data['is_published'] = $isPublished;
        $data['published_at'] = $this->resolvePublishedAt(
            $isPublished,
            $data['published_at'] ?? null
        );

        return Post::create($data);
    }


    public function update( array $data, Post $post ) : Post
    {
        if (array_key_exists('is_published', $data)) {

            $isPublished = !empty($data['is_published']);

            $data['is_published'] = $isPublished;

            $data['published_at'] = $this->resolvePublishedAt(
                $isPublished,
                $data['published_at'] ?? $post->published_at
            );
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

    private function resolvePublishedAt(bool $isPublished, $publishedAt): ?\Carbon\Carbon
    {
        if ($isPublished && !$publishedAt) {
            return now();
        }

        return $publishedAt;
    }


}
