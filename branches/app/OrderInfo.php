<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = 'order_info';

    protected $primaryKey = 'order_id';

	protected $fillable = [
		'order_sn',
		'uid',
		'pay_status',
		'consignee',
		'address',
		'mobile',
		'email',
		'postscript',
		'pay_id',
		'pay_name',
		'goods_amount',
		'created_at',
        'updated_at',
	];
}
