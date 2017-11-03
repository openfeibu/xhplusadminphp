<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class ShippingAdjust extends Model
{
    protected $table = 'shipping_adjust';

    protected $primaryKey = 'id';

    protected $fillable = [
    	'status',
        'name',
        'price',
    ];
}
