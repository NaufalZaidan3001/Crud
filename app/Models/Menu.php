<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    protected $table = 'menu_items';
    use SoftDeletes;
    protected function casts(): array
    {
        return [
            'deleted_at' => 'datetime',
        ];
    }

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
