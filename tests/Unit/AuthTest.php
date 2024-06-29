<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;


class AuthTest extends TestCase{
    use RefreshDatabase;

    public function credencialesIncompletas(){
        $request = Request::create('/api/login', 'POST', []);

        $controller = new AuthController();
        $response = $controller->login($request);

        $this->assertEquals(409, $response->status());
        $this->assertArrayHasKey('email', $response->getData(true)['errors']);
        $this->assertArrayHasKey('password', $response->getData(true)['errors']);
    }

    public function credencialesValidas(){
        $user = User::factory()->create([
            'email' => 'admin2@admin.com',
            'password' => bcrypt($password = '1234567'),
        ]);

        $request = Request::create('/api/login', 'POST', [
            'email' => 'admin2@admin.com',
            'password' => $password
        ]);

        $controller = new AuthController();
        $response = $controller->login($request);

        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('token', $response->getData(true));
    }

    public function credencialesInvalidas(){
        $user = User::factory()->create([
            'email' => 'admin3@admin.com',
            'password' => bcrypt('password'),
        ]);

        $request = Request::create('/api/login', 'POST', [
            'email' => 'admin2@admin.com',
            'password' => $password
        ]);

        $controller = new AuthController();
        $response = $controller->login($request);

        $this->assertEquals(401, $response->status());
    }    
}
