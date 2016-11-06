<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;
	
    protected $table = 'order';

    protected $primaryKey = 'oid';

	protected $fillable = ['order_sn','owner_id','courier_id','fee','alt_phone','description','destination','status','admin_deleted','created_at','updated_at','pay_id','total_fee','goods_fee','service_fee'];
	
    public function user()
    {
    	return $this->belongsTo('App\User', 'uid', 'owner_id');
    }

    public function history()
    {
        return $this->hasMany('App\OrderHistory', 'oid', 'oid');
    }
}
