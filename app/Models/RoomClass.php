<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
class RoomClass extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'number_of_beds',
        'number_of_baths'
    ];

    public function image():MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

}
