<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    protected $table = 'facilities';
    protected $fillable = ['name', 'description', 'icon_path'];
}
