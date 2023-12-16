<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AuthorApiTest extends TestCase
{
    use DatabaseMigrations;
    use TestTraits\AuthorTestRequestDataTrait;

    public function testCreateAuthor(): void
    {
        [$requestData, $expectedResponse] = $this->getCreateAuthorRequestData();

        $response = $this->postJson(
            uri: route(
                name: 'createAuthor'
            ),
            data: $requestData
        );

        $response->assertStatus(201);
        $response->assertJson($expectedResponse);

        $this->assertDatabaseHas('authors', $expectedResponse);
    }

    public function testGetAuthors(): void
    {
        $expectedResponse = $this->getAuthorsRequestData();

        $response = $this->getJson(
            uri: route(
                name: 'getAuthors'
            )
        );

        $response->assertStatus(200);

        $response->assertJson($expectedResponse);

        foreach ($expectedResponse as $author) {
            $this->assertDatabaseHas('authors', $author);
        }
    }

    public function testGetAuthor(): void
    {
        [$author, $expectedResponse] = $this->getAuthorRequestData();

        $response = $this->getJson(
            uri: route(
                name: 'getAuthor',
                parameters: ['id' => $author['id']]
            )
        );

        $response->assertStatus(200);

        $response->assertJson($expectedResponse);

        $this->assertDatabaseHas('authors', $author);
    }

    public function testUpdateAuthor(): void
    {
        [$author, $requestData, $expectedResponse] = $this->getUpdateAuthorRequestData();

        $response = $this->putJson(
            uri: route(
                name: 'updateAuthor',
                parameters: ['author' => $author['id']]
            ),
            data: $requestData
        );

        $response->assertJson($expectedResponse);

        $this->assertDatabaseHas('authors', $expectedResponse);
    }

    public function testDeleteAuthor(): void
    {
        [$author, $expectedResponse] = $this->getDeleteAuthorRequestData();

        $response = $this->deleteJson(
            uri: route(
                name: 'deleteAuthor',
                parameters: ['author' => $author['id']]
            )
        );

        $response->assertStatus(204);

        $this->assertSoftDeleted('authors', $expectedResponse);
    }

    public function testGetAuthorsWithPosts(): void
    {
        $expectedResponse = $this->getAuthorsWithPostsRequestData();

        $response = $this->getJson(
            uri: route(
                name: 'getAuthorsWithPosts'
            )
        );

        $response->assertStatus(200);

        $response->assertJson($expectedResponse);

        foreach ($expectedResponse as $author) {
            $this->assertDatabaseHas('authors', collect($author)->except('posts')->toArray());

            foreach ($author['posts'] as $post) {
                $this->assertDatabaseHas('posts', $post);
            }
        }
    }

    public function testGetAuthorWithPosts(): void
    {
        [$author, $expectedResponse] = $this->getAuthorWithPostsRequestData();

        $response = $this->getJson(
            uri: route(
                name: 'getAuthorWithPosts',
                parameters: ['author' => $author->id]
            )
        );

        $response->assertStatus(200);

        $response->assertJson($expectedResponse);

        $this->assertDatabaseHas('authors', collect($expectedResponse)->except('posts')->toArray());

        foreach ($expectedResponse['posts'] as $post) {
            $this->assertDatabaseHas('posts', $post);
        }
    }
}
