<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Restaurant;

class MenuItemApiTest extends TestCase
{
    use RefreshDatabase;

    private $token = 'restaurant_secret_api_key';

    public function test_can_create_menu_item()
    {
        $restaurant = Restaurant::create(['name' => 'R1', 'address' => 'A1']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson("/api/restaurants/{$restaurant->id}/menu_items", [
                             'name' => 'Item 1',
                             'price' => 10.5,
                             'category' => 'main'
                         ]);

        $response->assertStatus(201)
                 ->assertJsonPath('name', 'Item 1');
    }
}
