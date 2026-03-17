<?php

use Illuminate\Support\Facades\Route;
use App\Models\Restaurant;

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/admin', function () {
    $restaurants = Restaurant::all();
    return view('restaurants.index', compact('restaurants'));
});

Route::get('/admin/restaurants/{restaurant}', function (Restaurant $restaurant) {
    return view('restaurants.show', compact('restaurant'));
});
