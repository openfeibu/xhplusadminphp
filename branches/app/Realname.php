<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Realname extends Model
{
	use SoftDeletes;

    protected $table = 'realname';
    
    protected $dates = ['deleted_at'];

}
