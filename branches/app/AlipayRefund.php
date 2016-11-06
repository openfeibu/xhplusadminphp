<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AlipayRefund extends Model implements Transformable
{
    use TransformableTrait;

	protected $table = 'alipay_refund';

    protected $primaryKey = 'refund_id';
	
    protected $fillable = ['refund_id','batch_no','batch_num','success_num','detail_data','result_details','refund_status','created_at','updated_at'];

}
