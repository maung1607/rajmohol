<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RoomClass extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'price', 'discount'];
}
