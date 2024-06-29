<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Laravel\Passport\Passport;


final class GIFTest extends TestCase{
    public function testBuscarGifPorQuery(): void{
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->get('/api/gifs?query=car&limit=25&offset=0');
        $response->assertStatus(200);
    }

    public function testBuscarGifPorId(): void{
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->get("/api/gifs/3o6ZtjUZAD5Lf0QFLW");
        $response->assertStatus(200);
    }
}
