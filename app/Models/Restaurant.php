<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'opening_hours',
    ];

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
