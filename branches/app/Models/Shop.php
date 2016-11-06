<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shop';

    protected $primaryKey = 'shop_id';

    protected $fillable = [
    	'shop_name',
    	'shop_img',
    	'description',
    	'created_at',
        'updated_at',
        'shop_type',
        'uid',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','uid');
    }

}
