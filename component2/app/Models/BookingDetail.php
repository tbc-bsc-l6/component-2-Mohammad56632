<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'room_id',
        'user_name',
        'user_phone',
        'user_address',
        'check_out',
        'check_in',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'status' => 'boolean',
    ];

    /**
     * Get the user that owns the booking.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the room associated with the booking.
     */
    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
}
