<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class RoomInfo extends Model
{
    use SoftDeletes;
    protected $fillable = ['room_class_id','room_number','room_type','description','status'];

    public function room_class(): BelongsTo
    {
        return $this->belongsTo(RoomClass::class,'room_class_id','id');
    }
}
