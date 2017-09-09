<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class WechatRefund extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'wechat_refund';

    protected $primaryKey = 'refund_id';

    protected $fillable = [];

}
