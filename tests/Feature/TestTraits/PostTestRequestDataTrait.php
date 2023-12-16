<?php

namespace Tests\Feature\TestTraits;

use App\Models\Author;
use App\Models\Post;

trait PostTestRequestDataTrait
{
    public function getCreatePostRequestData(): array
    {
        $post = [
            'author_id' => Author::factory()->create()->id,
            'title' => 'post 1',
            'content' => 'content 1'
        ];

        $expectedResponse = [
            'id' => 1,
            'title' => 'post 1',
            'content' => 'content 1'
        ];

        return [$post, $expectedResponse];
    }

    public function getPostsRequestData(): array
    {
        $authorId = Author::factory()->create()->id;

        Post::factory()
            ->sequence([
                    'author_id' => $authorId,
                    'title' => 'post 1',
                    'content' => 'content 1'
                ],[
                    'author_id' => $authorId,
                    'title' => 'post 2',
                    'content' => 'content 2'
                ],[
                    'author_id' => $authorId,
                    'title' => 'post 3',
                    'content' => 'content 3'
                ],[
                    'author_id' => $authorId,
                    'title' => 'post 4',
                    'content' => 'content 4'
                ],[
                    'author_id' => $authorId,
                    'title' => 'post 5',
                    'content' => 'content 5'
                ])
            ->count(5)
            ->create();

        return [
            [
                'author_id' => $authorId,
                'title' => 'post 1',
                'content' => 'content 1'
            ],[
                'author_id' => $authorId,
                'title' => 'post 2',
                'content' => 'content 2'
            ],[
                'author_id' => $authorId,
                'title' => 'post 3',
                'content' => 'content 3'
            ],[
                'author_id' => $authorId,
                'title' => 'post 4',
                'content' => 'content 4'
            ],[
                'author_id' => $authorId,
                'title' => 'post 5',
                'content' => 'content 5'
            ]
        ];
    }

    public function getPostRequestData(): array
    {
        $authorId = Author::factory()->create()->id;

        $post = Post::factory()
            ->create([
                    'author_id' => $authorId,
                    'title' => 'post 1',
                    'content' => 'content 1'
            ]);

        $expectedResponse = [
            'author_id' => $authorId,
            'title' => 'post 1',
            'content' => 'content 1'
        ];

        return [$post->toArray(), $expectedResponse];
    }

    public function getUpdatePostRequestData(): array
    {
        $authorId = Author::factory()->create()->id;

        $post = Post::factory()
            ->create([
                'author_id' => $authorId,
                'title' => 'post 1',
                'content' => 'content 1'
            ]);

        $requestData = [
            'author_id' => $authorId,
            'title' => 'post 1 updated',
            'content' => 'content 1 updated'
        ];

        $expectedResponse = [
            'id' => 1,
            'author_id' => $authorId,
            'title' => 'post 1 updated',
            'content' => 'content 1 updated'
        ];

        return [$post->toArray(), $requestData, $expectedResponse];
    }

    public function getDeletePostRequestData(): array
    {
        $authorId = Author::factory()->create()->id;

        $post = Post::factory()
            ->create([
                'author_id' => $authorId,
                'title' => 'post 1 updated',
                'content' => 'content 1 updated'
            ]);

        $expectedResponse = [
            'id' => 1,
            'author_id' => $authorId,
            'title' => 'post 1 updated',
            'content' => 'content 1 updated'
        ];

        return [$post->toArray(), $expectedResponse];
    }
}
