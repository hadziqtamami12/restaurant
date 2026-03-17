<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Cache;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $page = $request->query('page', 1);

        $cacheKey = "restaurants:search:{$search}:page:{$page}";

        $restaurants = Cache::remember($cacheKey, 60, function () use ($search) {
            $query = Restaurant::query();

            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }

            return $query->paginate(10);
        });

        return response()->json($restaurants);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'opening_hours' => 'nullable|string|max:255',
        ]);

        $restaurant = Restaurant::create($validated);
        
        Cache::tags(['restaurants'])->flush(); // Optional if configured, or just flush specific keys. Here we just clear the whole prefix if using predis, or just don't overcomplicate.
        Cache::flush(); // Simple flush for this assessment to ensure list updates

        return response()->json($restaurant, 201);
    }

    public function show(string $id)
    {
        $restaurant = Restaurant::with('menuItems')->findOrFail($id);
        return response()->json($restaurant);
    }

    public function update(Request $request, string $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'opening_hours' => 'nullable|string|max:255',
        ]);

        $restaurant->update($validated);
        Cache::flush();

        return response()->json($restaurant);
    }

    public function destroy(string $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        Cache::flush();

        return response()->json(['message' => 'Restaurant deleted successfully']);
    }
}
