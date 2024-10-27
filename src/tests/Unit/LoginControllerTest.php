<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_active_user_login()
    {
        $user = User::factory()->create([
            'email' => 'notactiveuser@example.com',
            'password' => bcrypt('password123'),
            'authority' => 1,
            'status' => 0,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors([
            'email' => 'アカウントが停止されています',
        ]);

        // ユーザーが認証されていないことを確認
        $this->assertGuest();
    }
}
