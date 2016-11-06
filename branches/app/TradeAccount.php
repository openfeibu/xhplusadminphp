<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TradeAccount extends Model
{
    protected $table = 'trade_account';

    protected $primaryKey = 'id';
	
	protected $fillable = ['out_trade_no','trade_no','uid','trade_type','wallet_type','trade_status','description','from','pay_id','fee','service_fee','created_at','updated_at'];
}
