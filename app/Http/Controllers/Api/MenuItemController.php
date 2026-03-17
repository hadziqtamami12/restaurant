<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MenuItem;
use App\Models\Restaurant;

class MenuItemController extends Controller
{
    public function index(Request $request, string $restaurantId)
    {
        // GET /restaurants/:id/menu_items
        $restaurant = Restaurant::findOrFail($restaurantId);
        
        $query = $restaurant->menuItems();

        if ($request->has('category')) {
            $query->where('category', $request->query('category'));
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->query('search') . '%');
        }

        return response()->json($query->paginate(10));
    }

    public function store(Request $request, string $restaurantId)
    {
        // POST /restaurants/:id/menu_items
        $restaurant = Restaurant::findOrFail($restaurantId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100', // e.g., "appetizer", "main", "dessert", "drink"
            'is_available' => 'boolean',
        ]);

        $menuItem = $restaurant->menuItems()->create($validated);

        return response()->json($menuItem, 201);
    }

    public function update(Request $request, string $id)
    {
        // PUT /menu_items/:id
        $menuItem = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'category' => 'sometimes|required|string|max:100',
            'is_available' => 'boolean',
        ]);

        $menuItem->update($validated);

        return response()->json($menuItem);
    }

    public function destroy(string $id)
    {
        // DELETE /menu_items/:id
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();

        return response()->json(['message' => 'Menu item deleted successfully']);
    }
}
