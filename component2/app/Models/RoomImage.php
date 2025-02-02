<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    protected $fillable = ['room_id','image','status'];

    public function roomImage()
    {
        return $this->hasOne(RoomImage::class);
    }
}
