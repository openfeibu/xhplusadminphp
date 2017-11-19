<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletAccount extends Model
{
    protected $table = 'wallet_account';

    protected $primaryKey = 'id';

    protected $fillable = [
        'uid' ,
        'wallet',
        'fee',
        'service_fee',
        'out_trade_no' ,
        'wallet_type' ,
        'trade_type',
        'description' ,
    ];
}
