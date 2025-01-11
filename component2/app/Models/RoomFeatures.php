<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFeatures extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'feature_id',
    ];

    /**
     * Define the relationship with the Room model.
     */
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    /**
     * Define the relationship with the Feature model.
     */
    public function feature()
    {
        return $this->belongsTo(Features::class, 'feature_id');
    }
}
