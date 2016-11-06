<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WalletAccountRepository;
use App\WalletAccount;
use App\Validators\WalletAccountValidator;

/**
 * Class WalletAccountRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WalletAccountRepositoryEloquent extends BaseRepository implements WalletAccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WalletAccount::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function updateTradeType ($data,$out_trade_no)
    {
    	return WalletAccount::where('out_trade_no',$out_trade_no)->update($data);
    }
}
