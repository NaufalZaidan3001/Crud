<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'restaurant_name',
        'description',
        'address',
        'phone',
        'status',
        'user_id',
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}