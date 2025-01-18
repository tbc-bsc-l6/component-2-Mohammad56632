<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingOrder extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'arrive',
        'refund',
        'booking_status',
        'order_id',
        'amount',
        'trang_id',
        'status',
        'trang_response_mess'
    ];
}
