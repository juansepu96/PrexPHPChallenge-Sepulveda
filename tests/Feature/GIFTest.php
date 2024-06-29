<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Laravel\Passport\Passport;

class GIFTest extends TestCase{
    use RefreshDatabase;
    public function buscarGIFPorQuery(){
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->getJson('/api/gifs?query=car&limit=25&offset=0');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'url',
                ],
            ],
        ]);
    }

    public function buscarGIFPorID(){
        $user = User::factory()->create();
        Passport::actingAs($user);

        $gifId = "3o6ZtjUZAD5Lf0QFLW";
        $response = $this->getJson("/api/gifs/{$gifId}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'url',
        ]);
    }
}
