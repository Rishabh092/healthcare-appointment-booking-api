<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\User\Models\User;
use Laravel\Passport\Passport;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_fetch_profile()
    {
        $user = User::factory()->create();
        Passport::actingAs($user); // Use Passport for API guard

        $response = $this->getJson('/api/user/profile');

        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $user->email]);
    }

    public function test_unauthenticated_user_cannot_fetch_profile()
    {
        $response = $this->getJson('/api/user/profile');

        $response->assertStatus(401); // Unauthorized
    }

    public function test_user_can_register()
    {
        $payload = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'name', 'email']]);

        $this->assertDatabaseHas('users', ['email' => 'testuser@example.com']);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => 'secret123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'invalid@example.com',
            'password' => bcrypt('validpass'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
                 ->assertJsonFragment(['message' => 'Invalid credentials']);
    }
}
