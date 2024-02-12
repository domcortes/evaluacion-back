<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        $postId = 1;
        \App\Models\Comments::factory(3)->create(['post_id' => $postId]);

        $response = $this->getJson("/api/comments?posts_id=$postId");

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data']);
    }

    public function testCreate()
    {
        $response = $this->postJson('/api/comments', [
            'comment' => $this->faker->sentence,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['comment']]);
    }

    public function testShow()
    {
        $comment = \App\Models\Comments::factory()->create();

        $response = $this->getJson('/api/comments/' . $comment->id);

        $response->assertStatus(200)
            ->assertJson(['data' => ['comment' => $comment->comment]]);
    }

    public function testDestroy()
    {
        $comment = \App\Models\Comments::factory()->create();

        $response = $this->deleteJson('/api/comments/' . $comment->id);

        $response->assertStatus(204)
            ->assertNoContent();
    }
}
