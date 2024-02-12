<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriasControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        \App\Models\Categories::factory(3)->create();

        $response = $this->getJson('/api/categorias');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data']);
    }

    public function testCreate()
    {
        $response = $this->postJson('/api/categorias', [
            'title' => $this->faker->word,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['title']]);
    }

    public function testShow()
    {
        $categoria = \App\Models\Categories::factory()->create();

        $response = $this->getJson('/api/categorias/' . $categoria->id);

        $response->assertStatus(200)
            ->assertJson(['data' => ['title' => $categoria->title]]);
    }

    public function testUpdate()
    {
        $categoria = \App\Models\Categories::factory()->create();

        $response = $this->putJson('/api/categorias/' . $categoria->id, [
            'title' => $this->faker->word,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['title']]);
    }

    public function testDestroy()
    {
        $categoria = \App\Models\Categories::factory()->create();

        $response = $this->deleteJson('/api/categorias/' . $categoria->id);

        $response->assertStatus(204)
            ->assertNoContent();
    }
}
