<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{

    protected $fillable = [
        'name', 'area', 'price', 'quantity', 'adult', 'children', 'description', 'status', 'removed'
    ];

    public function features()
    {
        return $this->hasMany(RoomFeatures::class, 'room_id');
    }

    /**
     * Define the relationship with the RoomFacilities model.
     */
    public function facilities()
    {
        return $this->hasMany(RoomFacilities::class, 'room_id');
    }
}
