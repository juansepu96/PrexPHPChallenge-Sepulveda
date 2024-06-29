<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Laravel\Passport\Passport;

final class GIFFavoriteTest extends TestCase{
    public function guardarGIFFavorito()  {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->postJson('/api/gifs/favorite', [
            'gif_id' => "3o6ZtjUZAD5Lf0QFLW",
            'alias' => 'Waynes World Car GIF by Hollywood Suite',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'GIF favorito guardado exitosamente.',
        ]);
    }
}