<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shop';

    protected $primaryKey = 'shop_id';

    protected $fillable = [
    	'uid',
    	'shop_name',
    	'shop_img',
    	'description',
        'shop_type',
        'shop_status',
        'open_time',
        'close_time',
        'description',
        'created_at',
        'updated_at',
    ];
    public function goodses()
    {
        return $this->hasMany('App\Goods','shop_id');
    }

}
