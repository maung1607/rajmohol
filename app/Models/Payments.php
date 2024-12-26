<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payments extends Model
{
    use SoftDeletes;

    protected $fillable = ['payment_number','actual_amount','total_amount','paid_amount','due_amount','discount','payment_method','status','payment_date'];

    
}
