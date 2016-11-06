<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Real_name_auth extends Model
{
	use SoftDeletes;

    protected $table = 'real_name_auth';
    
    protected $dates = ['deleted_at'];

}