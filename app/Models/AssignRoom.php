<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssignRoom extends Model
{
    use SoftDeletes;
    protected $fillable = ['reservation_id', 'room_info_id'];
}
