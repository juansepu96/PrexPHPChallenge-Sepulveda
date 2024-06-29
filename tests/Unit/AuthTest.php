<?php 

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthTest extends TestCase{

    public function testCredencialesIncompletas():void{

        $response = $this->post('/api/login', [
            'password' => '123456',
            'emailsdm' => 'admin@admin.com',
        ]);

        $response->assertStatus(409);
    }

    public function testCredencialesValidas():void{

        $response = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => '123456'
        ]);

        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('access_token', $response->getData(true));
    }

    public function testCredencialesInvalidas():void{

        $response = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => '1234567'
        ]);

        $this->assertEquals(401, $response->status());
    }    
}
