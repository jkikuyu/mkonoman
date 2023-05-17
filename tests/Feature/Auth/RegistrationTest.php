<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $user = User::factory()->make();
        $response = $this->post('/register', [$user]);

        /*         $response = $this->post('/register', [
            'phone' => '2345677',
            'type' => '1',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]); */

        $this->assertAuthenticated();
        $response->assertNoContent();
    }
}
