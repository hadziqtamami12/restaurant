<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Restaurant;

class RestaurantApiTest extends TestCase
{
    use RefreshDatabase;

    private $token = 'restaurant_secret_api_key';

    public function test_can_list_restaurants()
    {
        Restaurant::create([
            'name' => 'Test Restaurant',
            'address' => '123 Main St',
        ]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->getJson('/api/restaurants');

        $response->assertStatus(200);
    }

    public function test_can_create_restaurant()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson('/api/restaurants', [
                             'name' => 'Test',
                             'address' => '123 Test St',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonPath('name', 'Test');
    }

    public function test_rejects_unauthorized()
    {
        $response = $this->getJson('/api/restaurants');
        $response->assertStatus(401);
    }
}
