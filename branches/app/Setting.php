<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'display_name',
        'name',
        'value',
    ];
}
