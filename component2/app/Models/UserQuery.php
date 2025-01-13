<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserQuery extends Model
{
    protected $fillable = ['name', 'email', 'subject', 'message', 'status'];
}
