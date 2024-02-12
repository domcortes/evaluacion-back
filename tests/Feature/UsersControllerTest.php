<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testIndex()
    {
        \App\Models\User::factory(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure(['data']);
    }

    public function testCreate()
    {
        $response = $this->postJson('/api/users', [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'role' => 'user',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => ['name', 'email', 'role']]);
    }

    public function testShow()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->getJson('/api/users/' . $user->id);

        $response->assertStatus(200)
            ->assertJson(['data' => ['name' => $user->name, 'email' => $user->email, 'role' => $user->role]]);
    }

    public function testDestroy()
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(204);
    }
}
