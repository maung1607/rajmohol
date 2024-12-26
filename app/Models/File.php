<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class File extends Model
{
    use SoftDeletes;

    protected $fillable = ['fileable_id','fileable_type','value'];

    public function fileable()
    {
        return $this->morphTo();
    }
}
