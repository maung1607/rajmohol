<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reservation extends Model
{
    use SoftDeletes;
    protected $fillable = ['customer_id','payment_id',
    'creator_id','check_in_date','check_out_date','adults',
    'children','status','day_range'];

    public function customer():BelongsTo
    {
        return $this->BelongsTo(User::class,'customer_id');
    }
}
