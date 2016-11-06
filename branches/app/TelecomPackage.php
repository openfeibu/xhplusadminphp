<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelecomPackage extends Model
{
    protected $table = 'telecom_package';

    protected $primaryKey = 'package_id';
	
	protected $fillable = ['package_id','package_name','package_detail','package_price','sort','created_at','updated_at'];
}
