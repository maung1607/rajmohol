<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'booking_id',
        'customer_id',
        'address_id',
        'payment_id',
        'creator_id',
        'check_in_date',
        'check_out_date',
        'adults',
        'children',
        'status',
        'day_range'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
    
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payments::class,'payment_id');
    }

    public function assign_rooms(): HasMany
    {
        return $this->hasMany(AssignRoom::class,'reservation_id');
    }

    
}
