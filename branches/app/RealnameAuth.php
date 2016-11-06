<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealnameAuth extends Model
{
    protected $table = 'real_name_auth';

    public function user()
    {
    	return $this->belongsTo('App\User', 'uid', 'uid');
    }
}
