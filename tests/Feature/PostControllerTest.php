<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        \App\Models\Posts::factory(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data']);
    }

    public function testCreate()
    {
        $response = $this->postJson('/api/posts', [
            'userId' => 1,
            'categoryId' => 1,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['title', 'body']]);
    }

    public function testShow()
    {
        $post = \App\Models\Posts::factory()->create();

        $response = $this->getJson('/api/posts/' . $post->id);

        $response->assertStatus(200)
            ->assertJson(['data' => ['title' => $post->title, 'body' => $post->body]]);
    }

    public function testUpdate()
    {
        $post = \App\Models\Posts::factory()->create();

        $response = $this->putJson('/api/posts/' . $post->id, [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['title', 'body']]);
    }

    public function testDestroy()
    {
        $post = \App\Models\Posts::factory()->create();

        $response = $this->deleteJson('/api/posts/' . $post->id);

        $response->assertStatus(200)
            ->assertJson(['data' => ['title' => $post->title, 'body' => $post->body]]);
    }
}
