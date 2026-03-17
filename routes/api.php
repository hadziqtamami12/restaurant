<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\MenuItemController;

Route::middleware('api.token')->group(function () {
    Route::apiResource('restaurants', RestaurantController::class);
    
    // Nested routes for Menu Items
    Route::get('restaurants/{restaurant}/menu_items', [MenuItemController::class, 'index']);
    Route::post('restaurants/{restaurant}/menu_items', [MenuItemController::class, 'store']);
    
    // Direct routes for updating/deleting Menu Items
    Route::put('menu_items/{menu_item}', [MenuItemController::class, 'update']);
    Route::delete('menu_items/{menu_item}', [MenuItemController::class, 'destroy']);
});
