<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class AssignRoom extends Model
{
    use SoftDeletes;
    protected $fillable = ['reservation_id', 'room_info_id'];

    public function room_info():BelongsTo
    {
        return $this->belongsTo(RoomInfo::class,'room_info_id');
    }
}
