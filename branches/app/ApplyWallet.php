<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyWallet extends Model
{
    protected $table = 'apply_wallet';

    protected $primaryKey = 'apply_id';
	
	protected $fillable = ['uid','out_trade_no','fee','service_fee','total_fee','status','description','alipay','alipay_name','created_at','updated_at'];
}
