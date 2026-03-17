<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $r1 = \App\Models\Restaurant::create([
            'name' => 'Italian Gusto',
            'address' => '123 Pasta Street',
            'phone' => '555-0101',
            'opening_hours' => '10:00 - 22:00',
        ]);

        $r1->menuItems()->createMany([
            ['name' => 'Bruschetta', 'description' => 'Toasted bread with tomatoes', 'price' => 5.99, 'category' => 'appetizer', 'is_available' => true],
            ['name' => 'Spaghetti Carbonara', 'description' => 'Pasta with creamy egg sauce and pancetta', 'price' => 14.99, 'category' => 'main', 'is_available' => true],
            ['name' => 'Margherita Pizza', 'description' => 'Classic cheese and tomato pizza', 'price' => 12.99, 'category' => 'main', 'is_available' => true],
            ['name' => 'Tiramisu', 'description' => 'Coffee-flavored Italian dessert', 'price' => 7.99, 'category' => 'dessert', 'is_available' => true],
            ['name' => 'Espresso', 'description' => 'Strong Italian coffee', 'price' => 2.99, 'category' => 'drink', 'is_available' => true],
        ]);

        $r2 = \App\Models\Restaurant::create([
            'name' => 'Tokyo Bites',
            'address' => '456 Sushi Ave',
            'phone' => '555-0202',
            'opening_hours' => '11:00 - 23:00',
        ]);

        $r2->menuItems()->createMany([
            ['name' => 'Edamame', 'description' => 'Steamed soybeans', 'price' => 4.99, 'category' => 'appetizer', 'is_available' => true],
            ['name' => 'Spicy Tuna Roll', 'description' => 'Sushi roll with spicy tuna', 'price' => 8.99, 'category' => 'main', 'is_available' => true],
            ['name' => 'Chicken Teriyaki', 'description' => 'Grilled chicken with sweet soy glaze', 'price' => 13.99, 'category' => 'main', 'is_available' => true],
            ['name' => 'Mochi Ice Cream', 'description' => 'Japanese sweet rice cake with ice cream filling', 'price' => 5.99, 'category' => 'dessert', 'is_available' => true],
            ['name' => 'Green Tea', 'description' => 'Hot Japanese green tea', 'price' => 1.99, 'category' => 'drink', 'is_available' => true],
        ]);
    }
}
