<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    // Test 1: Login berhasil
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::where('email', 'mabipalaka@gmail.com')->first();

        $response = $this->post('/login', [
            'email' => 'mabipalaka@gmail.com',
            'password' => '12345',
        ]);

        dd($response->getContent());
        // $response->assertRedirect(route('home'));
        // $this->assertAuthenticatedAs($user);
    }

    // Test 2: Login gagal karena password salah
    public function test_login_fails_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email' => 'mabi@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'mabi@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    // Test 3: Validasi input gagal
    public function test_login_fails_when_input_is_invalid(): void
    {
        $response = $this->post('/login', [
            'email' => 'email-tidak-valid',
            'password' => '',
        ]);

        $response->assertSessionHasErrors([
            'email',
            'password',
        ]);

        $this->assertGuest();
    }
}