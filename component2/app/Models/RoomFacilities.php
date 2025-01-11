<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFacilities extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'facility_id',
    ];

    /**
     * Define the relationship with the Room model.
     */
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    /**
     * Define the relationship with the Facility model.
     */
    public function facility()
    {
        return $this->belongsTo(Facilities::class, 'facility_id');
    }
}
