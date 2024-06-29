<?php 
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Laravel\Passport\Passport;


final class testGIFFavoriteTest extends TestCase{
    public function testGuardarGifFavorito():void {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->post('/api/favorites', [
            'gif_id' => "3o6ZtjUZAD5Lf0QFLW",
            'alias' => 'Waynes World Car GIF by Hollywood Suite',
            'user_id' => 3,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'GIF favorito guardado exitosamente.',
        ]);
    }
}