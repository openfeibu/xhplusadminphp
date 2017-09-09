<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TradeAccountRepository;
use App\TradeAccount;
use App\Validators\TradeAccountValidator;
use APP\Services\MessageService;
/**
 * Class TradeAccountRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TradeAccountRepositoryEloquent extends BaseRepository implements TradeAccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TradeAccount::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function refundOrder($trade_no)
    {
        $trade = $this->findWhere(['trade_no'=>$trade_no,'trade_status'=>'refunding'],$columns =['uid','id','from','trade_no','out_trade_no','fee'])->first();
		if($trade){
			$this->update(['trade_status'=>'refunded'],$trade->id);
			if($trade->from == 'order'){

				$update = app('orderRepositoryEloquent')->updateBySn(['status'=>'cancelled'],$trade->out_trade_no);
				if($update){

					$this->messageService->SystemMessage2SingleOne($trade->uid, "任务金额 " . $trade->fee . "元 已原路退回，请注意查收");
				}
			}
		}
    }
}
