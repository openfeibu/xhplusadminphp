<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class CanteenShippingConfig extends Model
{
    protected $table = 'canteen_shipping_config';

    protected $primaryKey = 'cid';

    public $timestamps = false;

    protected $fillable = [
    	'min',
        'max',
        'weight',
        'outweight',
        'shipping_fee',
        'payer',
    ];
}
