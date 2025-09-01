<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * verifier la connexion en utilisant JWT
     */

    public function test_login_avec_jwt()
    {
        User::factory()->create([
            'email' => 'mbiapoidriss@gmail.com',
            'password' => bcrypt('P@ssW0rd')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'mbiapoidriss@gmail.com',
            'password' => 'P@ssW0rd'
        ]);

        $response->assertStatus(200)->assertJsonStructure(['access_token', 'token_type', 'expires_in','user']);
    }
}
