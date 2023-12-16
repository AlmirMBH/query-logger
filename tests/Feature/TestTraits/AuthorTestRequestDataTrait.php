<?php

namespace Tests\Feature\TestTraits;

use App\Models\Author;
use App\Models\Post;

trait AuthorTestRequestDataTrait
{
    public function getCreateAuthorRequestData(): array
    {
        $author = [
            'name' => 'Almir Mustafic',
            'email' => 'almir.mustafic@gmail.com',
            'github' => 'https://github.com/AlmirMBH',
            'twitter' => 'https://twitter.com/AlmirMBH',
            'location' => 'Sarajevo, BiH'
        ];

        $expectedResponse = [
            'id' => 1,
            'name' => 'Almir Mustafic',
            'email' => 'almir.mustafic@gmail.com',
            'github' => 'https://github.com/AlmirMBH',
            'twitter' => 'https://twitter.com/AlmirMBH',
            'location' => 'Sarajevo, BiH'
        ];

        return [$author, $expectedResponse];
    }

    public function getAuthorsRequestData(): array
    {
        Author::factory()
            ->sequence(
                [
                    'name' => 'Almir Mustafic',
                    'email' => 'almir.mustafic@gmail.com',
                    'github' => 'https://github.com/AlmirMBH',
                    'twitter' => 'https://twitter.com/AlmirMBH',
                    'location' => 'Sarajevo, BiH'
                ],[
                    'name' => 'John Doe',
                    'email' => 'john.doe@ghmail.com',
                    'github' => 'https://github.com/John',
                    'twitter' => 'https://twitter.com/John',
                    'location' => 'Tuzla, BiH'
                ],[
                    'name' => 'Jane Doe',
                    'email' => 'jane.doe@gmail.com',
                    'github' => 'https://github.com/Jane',
                    'twitter' => 'https://twitter.com/Jane',
                    'location' => 'Mostar, BiH'
                ],[
                    'name' => 'John Smith',
                    'email' => 'john@gmail.com',
                    'github' => 'https://github.com/JohnS',
                    'twitter' => 'https://twitter.com/JohnS',
                    'location' => 'Banja Luka, BiH'
                ],[
                    'name' => 'Jane Smith',
                    'email' => 'jane@gmail.com',
                    'github' => 'https://github.com/JaneS',
                    'twitter' => 'https://twitter.com/JaneS',
                    'location' => 'Zenica, BiH'
                ]
            )
            ->count(5)
            ->create();

        return [
            [
                'id' => 1,
                'name' => 'Almir Mustafic',
                'email' => 'almir.mustafic@gmail.com',
                'github' => 'https://github.com/AlmirMBH',
                'twitter' => 'https://twitter.com/AlmirMBH',
                'location' => 'Sarajevo, BiH'
            ],[
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'john.doe@ghmail.com',
                'github' => 'https://github.com/John',
                'twitter' => 'https://twitter.com/John',
                'location' => 'Tuzla, BiH'
            ],[
                'id' => 3,
                'name' => 'Jane Doe',
                'email' => 'jane.doe@gmail.com',
                'github' => 'https://github.com/Jane',
                'twitter' => 'https://twitter.com/Jane',
                'location' => 'Mostar, BiH'
            ],[
                'id' => 4,
                'name' => 'John Smith',
                'email' => 'john@gmail.com',
                'github' => 'https://github.com/JohnS',
                'twitter' => 'https://twitter.com/JohnS',
                'location' => 'Banja Luka, BiH'
            ],[
                'id' => 5,
                'name' => 'Jane Smith',
                'email' => 'jane@gmail.com',
                'github' => 'https://github.com/JaneS',
                'twitter' => 'https://twitter.com/JaneS',
                'location' => 'Zenica, BiH'
            ]
        ];
    }

    public function getAuthorRequestData(): array
    {
        $author = Author::factory()
            ->create([
                'name' => 'Almir Mustafic',
                    'email' => 'almir.mustafic@gmail.com',
                    'github' => 'https://github.com/AlmirMBH',
                    'twitter' => 'https://twitter.com/AlmirMBH',
                    'location' => 'Sarajevo, BiH'
            ]);

        $expectedResponse = [
                'id' => 1,
                'name' => 'Almir Mustafic',
                'email' => 'almir.mustafic@gmail.com',
                'github' => 'https://github.com/AlmirMBH',
                'twitter' => 'https://twitter.com/AlmirMBH',
                'location' => 'Sarajevo, BiH'
        ];

        return [$author->toArray(), $expectedResponse];
    }

    public function getUpdateAuthorRequestData(): array
    {
        $author = Author::factory()
            ->create([
                'name' => 'Almir Mustafic',
                'email' => 'almir.mustafic@gmail.com',
                'github' => 'https://github.com/AlmirMBH',
                'twitter' => 'https://twitter.com/AlmirMBH',
                'location' => 'Sarajevo, BiH'
            ]);

        $requestData = [
            'name' => 'Almir Mustafic',
            'email' => 'almir.mustafic.tz@gmail.com',
            'github' => 'https://github.com/AlmirMBH',
            'twitter' => 'https://twitter.com/AlmirMBH',
            'location' => 'Sarajevo, BiH'
        ];

        $expectedResponse = [
            'id' => 1,
            'name' => 'Almir Mustafic',
            'email' => 'almir.mustafic.tz@gmail.com',
            'github' => 'https://github.com/AlmirMBH',
            'twitter' => 'https://twitter.com/AlmirMBH',
            'location' => 'Sarajevo, BiH'
        ];

        return [$author->toArray(), $requestData, $expectedResponse];
    }

    public function getDeleteAuthorRequestData(): array
    {
        $author = Author::factory()
            ->create([
                'name' => 'Almir Mustafic',
                'email' => 'almir.mustafic@gmail.com',
                'github' => 'https://github.com/AlmirMBH',
                'twitter' => 'https://twitter.com/AlmirMBH',
                'location' => 'Sarajevo, BiH'
            ]);

        $expectedResponse = [
            'id' => 1,
            'name' => 'Almir Mustafic',
            'email' => 'almir.mustafic@gmail.com',
            'github' => 'https://github.com/AlmirMBH',
            'twitter' => 'https://twitter.com/AlmirMBH',
            'location' => 'Sarajevo, BiH'
        ];

        return [$author->toArray(), $expectedResponse];
    }

    public function getAuthorsWithPostsRequestData(): array
    {
        Author::factory()
            ->sequence(
                [
                    'name' => 'Almir Mustafic',
                    'email' => 'almir.mustafic@gmail.com',
                    'github' => 'https://github.com/AlmirMBH',
                    'twitter' => 'https://twitter.com/AlmirMBH',
                    'location' => 'Sarajevo, BiH'
                ],[
                    'name' => 'John Doe',
                    'email' => 'john.doe@ghmail.com',
                    'github' => 'https://github.com/John',
                    'twitter' => 'https://twitter.com/John',
                    'location' => 'Tuzla, BiH'
                ]
            )
            ->has(
                Post::factory()
                    ->sequence(
                        [
                            'title' => 'Post 1',
                            'content' => 'Post 1 content'
                        ],[
                            'title' => 'Post 2',
                            'content' => 'Post 2 content'
                        ],[
                            'title' => 'Post 3',
                            'content' => 'Post 3 content'
                        ],[
                            'title' => 'Post 4',
                            'content' => 'Post 4 content'
                        ],[
                            'title' => 'Post 5',
                            'content' => 'Post 5 content'
                        ])
                    ->count(2)
            )
            ->count(2)
            ->create();

        return [
            [
                'id' => 1,
                'name' => 'Almir Mustafic',
                'email' => 'almir.mustafic@gmail.com',
                'github' => 'https://github.com/AlmirMBH',
                'twitter' => 'https://twitter.com/AlmirMBH',
                'location' => 'Sarajevo, BiH',
                'posts' => [
                    [
                        'id' => 1,
                        'author_id' => 1,
                        'title' => 'Post 1',
                        'content' => 'Post 1 content'
                    ],[
                        'id' => 2,
                        'author_id' => 1,
                        'title' => 'Post 2',
                        'content' => 'Post 2 content'
                    ]
                ]
            ],[
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'john.doe@ghmail.com',
                'github' => 'https://github.com/John',
                'twitter' => 'https://twitter.com/John',
                'location' => 'Tuzla, BiH',
                'posts' => [
                    [
                        'id' => 3,
                        'author_id' => 2,
                        'title' => 'Post 3',
                        'content' => 'Post 3 content'
                    ],[
                        'id' => 4,
                        'author_id' => 2,
                        'title' => 'Post 4',
                        'content' => 'Post 4 content'
                    ]
                ]
            ]
        ];
    }

    public function getAuthorWithPostsRequestData(): array
    {
        $author = Author::factory()
            ->sequence(
                [
                    'name' => 'Almir Mustafic',
                    'email' => 'almir.mustafic@gmail.com',
                    'github' => 'https://github.com/AlmirMBH',
                    'twitter' => 'https://twitter.com/AlmirMBH',
                    'location' => 'Sarajevo, BiH'
                ]
            )
            ->has(
                Post::factory()
                    ->sequence([
                            'title' => 'Post 1',
                            'content' => 'Post 1 content'
                        ],[
                            'title' => 'Post 2',
                            'content' => 'Post 2 content'
                        ])
                    ->count(2)
            )
            ->create();

        $expectedResponse = [
                'id' => 1,
                'name' => 'Almir Mustafic',
                'email' => 'almir.mustafic@gmail.com',
                'github' => 'https://github.com/AlmirMBH',
                'twitter' => 'https://twitter.com/AlmirMBH',
                'location' => 'Sarajevo, BiH',
                'posts' => [
                    [
                        'id' => 1,
                        'author_id' => 1,
                        'title' => 'Post 1',
                        'content' => 'Post 1 content'
                    ],[
                        'id' => 2,
                        'author_id' => 1,
                        'title' => 'Post 2',
                        'content' => 'Post 2 content'
                    ]
                ]
        ];

        return [$author, $expectedResponse];
    }
}
