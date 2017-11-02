<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TelecomEnrollment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

}
