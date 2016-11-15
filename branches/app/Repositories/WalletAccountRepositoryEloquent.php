<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WalletAccountRepository;
use App\WalletAccount;
use DB;
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
    /*Ç®°üÃ÷Ï¸*/
	public function getWalletAccount ($uid)
	{
		$accounts =  WalletAccount::select(DB::raw('id,uid,description,trade_type,wallet_type,fee,service_fee,wallet,updated_at,out_trade_no,created_at'))
					->where('uid',$uid)
					->orderBy('id','desc')
					->paginate(config('admin_config.page'));
					
		foreach( $accounts as $key => $account )
		{
			$account->trade_type = trans("common.trade_type.$account->trade_type");
			$account->wallet_type_trans = trans("common.wallet_type.$account->wallet_type");
			$account->fee = $account->wallet_type == 1 ? '+'.$account->fee : '-'.$account->fee;
		}	

		return $accounts;
	}
}
