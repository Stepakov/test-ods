<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PostService
{
    public function store( array $data ) : Post
    {
        $isPublished = !empty( $data[ 'is_published' ] );
        $publishedAt = $data[ 'published_at' ] ?? null;

        if (
            $isPublished // якщо пост публікується
            &&
            !$publishedAt // і дата не задана
        ) {
            $publishedAt = now(); // встановлювати поточну дату
        }

        return Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
        ]);
    }


    public function update( array $data, Post $post ) : Post
    {
        // В апдейт передали из_паблішт
        if (array_key_exists('is_published', $data)) {

            $isPublished = !empty($data['is_published']);
            $data['is_published'] = $isPublished;

            // Якщо публікуєм, то чи потрібно ставити дату?
            if (
                $isPublished && // якщо пост публікується
                empty($data['published_at']) && // не всказана дата в апдейт-запросі
                !$post->published_at // в запису порожне поле з датою публікації
            ) {
                $data['published_at'] = now(); // тоді вписуємо поточну дату
            }
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
