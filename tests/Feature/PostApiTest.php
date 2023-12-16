<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use DatabaseMigrations;
    use TestTraits\PostTestRequestDataTrait;


    public function testCreatePost(): void
    {
        [$requestData, $expectedResponse] = $this->getCreatePostRequestData();

        $response = $this->postJson(
            uri: route(
                name: 'createPost'
            ),
            data: $requestData
        );

        $response->assertStatus(201);
        $response->assertJson($expectedResponse);

        $this->assertDatabaseHas('posts', $expectedResponse);
    }

    public function testGetPosts(): void
    {
        $expectedResponse = $this->getPostsRequestData();

        $response = $this->getJson(
            uri: route(
                name: 'getPosts'
            )
        );

        $response->assertStatus(200);

        $response->assertJson($expectedResponse);

        foreach ($expectedResponse as $post) {
            $this->assertDatabaseHas('posts', $post);
        }
    }

    public function testGetPost(): void
    {
        [$post, $expectedResponse] = $this->getPostRequestData();

        $response = $this->getJson(
            uri: route(
                name: 'getPost',
                parameters: ['id' => $post['id']]
            )
        );

        $response->assertStatus(200);

        $response->assertJson($expectedResponse);

        $this->assertDatabaseHas('posts', $post);
    }

    public function testUpdatePost(): void
    {
        [$post, $requestData, $expectedResponse] = $this->getUpdatePostRequestData();

        $response = $this->putJson(
            uri: route(
                name: 'updatePost',
                parameters: ['post' => $post['id']]
            ),
            data: $requestData
        );

        $response->assertJson($expectedResponse);

        $this->assertDatabaseHas('posts', $expectedResponse);
    }

    public function testDeletePost(): void
    {
        [$post, $expectedResponse] = $this->getDeletePostRequestData();

        $response = $this->deleteJson(
            uri: route(
                name: 'deletePost',
                parameters: ['post' => $post['id']]
            )
        );

        $response->assertStatus(204);

        $this->assertSoftDeleted('posts', $expectedResponse);
    }
}
