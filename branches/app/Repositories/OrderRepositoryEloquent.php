<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use App\Order;
use App\Validators\OrderValidator;
use DB;

/**
 * Class OrderRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

	/**
	 * 获取任务列表
	 */
	public function getOrderList()
	{
        return Order::select(DB::raw('order.oid,order.order_sn,order.fee,order.service_fee,  order.status, order.updated_at,order.created_at,owner_user.nickname as owner_nickname,order.description,order.destination,
                                        if(courier_user.nickname IS NULL,"",courier_user.nickname) as courier_nickname'))
                      ->join('user as owner_user', 'order.owner_id', '=', 'owner_user.uid')
                      ->leftJoin('user as courier_user', 'order.courier_id', '=', 'courier_user.uid')
                      ->where('order.admin_deleted', 0)
                      ->orderBy('order.created_at', 'desc')
					  ->paginate(config('admin_config.page'));
	}
	public function getRefundOrders()
	{
		return Order::select(DB::raw('order.oid,order.order_sn,order.fee,order.status,order.updated_at,trade.created_at,order.pay_id,user.nickname,user.uid,trade.trade_no'))
						->join('user','order.owner_id','=','user.uid')
						->join('trade_account as trade','order.order_sn','=','trade.out_trade_no')
						->where('order.admin_deleted', 0)
						->where('order.pay_id','<>',3)
						->whereIn('order.status', ['cancelling'])
						->orderBy('order.created_at', 'desc')
						->paginate(config('admin_config.page'));
	}
	public function getRefundOrder($id)
	{
		return Order::select(DB::raw('order.oid,order.order_sn,order.fee,order.status,order.created_at,order.pay_id,user.nickname,user.uid,trade.trade_no'))
						->join('user','order.owner_id','=','user.uid')
						->join('trade_account as trade','order.order_sn','=','trade.out_trade_no')
						->where('order.oid', $id)
						->first();

	}
	public function updateBySn($update,$order_sn)
	{
		return Order::where('order_sn',$order_sn)->update($update);
	}
	public function getRefundOrdersByIds($ids)
	{
		return Order::select(DB::raw('order.oid,order.order_sn,order.fee,order.status,order.created_at,order.pay_id,user.nickname,user.uid,trade.trade_no'))
						->leftJoin('user','order.owner_id','=','user.uid')
						->leftJoin('trade_account as trade','order.order_sn','=','trade.out_trade_no')
						->whereIn('order.oid', $ids)
						->get();

	}
    public function getTodayRank($start)
    {
        $end = $start." 23:59:59";
        $start = $start.' 00:00:00';
        $users = Order::select(DB::raw("count('*') as count,order.courier_id,user.uid,user.nickname,user_info.realname,user.mobile_no"))
                        ->join('user','user.uid','=','order.courier_id')
                        ->join('user_info','user.uid','=','user_info.uid')
                        ->join('order_status_history as osh','osh.oid','=','order.oid')
                        ->whereBetween('osh.created_at',[$start,$end])
                        ->where('osh.new_status','finish')
                        ->distinct('order.oid')
                        ->orderBy('count','desc')
                        ->groupBy('order.courier_id')
                        ->get();
        return $users;
    }
    public function getMonthDayRank()
    {
        $ranks = Order::select(DB::raw("count('*') as count,DATE_FORMAT(osh.created_at,'%Y-%m-%d') as datemd"))
                        ->join('order_status_history as osh','osh.oid','=','order.oid')
                        ->whereRaw("DATE_FORMAT(osh.created_at,'%Y-%m') = '2017-09' ")
                        ->where('osh.new_status','finish')
                        ->where('order.type','canteen')
                        ->distinct('order.oid')
                        ->orderBy('datemd','asc')
                        ->groupBy('datemd')
                        ->get()
                        ->toArray();
        return $ranks;
    }

}
