<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'id',
        'restaurant_id',
        'item_name',
        'description',
        'price',
        'image',
        'availability',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
