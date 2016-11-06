<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TelecomOrder extends Model
{
	use SoftDeletes;
	
    protected $table = 'telecom_order';

    protected $primaryKey = 'id';
	
	//protected $fillable = array('name', 'idcard', 'major','dormitory_no','student_id','telecom_outOrderNumber');
	protected $fillable= ['telecom_trade_no','trade_no','uid','telecom_outOrderNumber','idcard','name','major','dormitory_no','student_id','fee','package_id','package_name','pay_status','created_at','updated_at'];

}
