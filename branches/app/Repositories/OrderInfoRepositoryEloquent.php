<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderInfoRepository;
use DB;
use App\OrderInfo;
use App\OrderGoods;
use App\Validators\OrderInfoRepositoryValidator;

/**
 * Class OrderInfoRepositoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OrderInfoRepositoryEloquent extends BaseRepository implements OrderInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderInfo::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getOrderInfos ()
    {
    	$order_infos = OrderInfo::select(DB::raw('shop.uid as shop_uid,shop.shop_id,shop.shop_name,shop.shop_img,user.nickname,order_info.*'))
							->leftJoin('shop', 'shop.shop_id', '=', 'order_info.shop_id')
							->leftJoin('user','user.uid','=','order_info.uid')
							->orderBy('order_id','desc')
							->paginate(config('admin_config.page'));
		foreach( $order_infos as $key => $order_info )
		{
			$order_goodses =  $this->getOrderGoodses($order_info->order_id);
			$goods_number = 0;
			foreach( $order_goodses as $k => $order_goods )
			{
				$goods_number = $goods_number + $order_goods->goods_number;
				$order_goods->total_fee = $order_goods->goods_price * $order_goods->goods_number;
				$goods = app('goodsRepositoryEloquent')->getGoods(['goods_id' => $order_goods->goods_id],['goods_img','goods_thumb']);
				if(!$goods){
					$order_goods->goods_img = $order_goods->goods_thumb = config('common.no_goods_img');
				}else{
					$order_goods->goods_img = $goods->goods_img;
					$order_goods->goods_thumb = $goods->goods_thumb;
				}
			}
			$order_info->order_goodses = $order_goodses;
			$order_info->goods_number = $goods_number;
			$order_info->status_desc = trans('common.pay_status.'.$order_info->pay_status);
			if($order_info->pay_status == 1){
				$order_info->status_desc = trans('common.order_status.buyer.'.$order_info->order_status);
				if($order_info->order_status == 1)
				{
					$order_info->status_desc = trans('common.shipping_status.'.$order_info->shipping_status);
				}
			}
			$result = check_refund_order_info($order_info->pay_status,$order_info->shipping_status,$order_info->order_status);
			$order_info->can_cancel = 1;
			if(!$result){
				$order_info->can_cancel = 0;
			}
		}
		return $order_infos;
    }
    public function getOrderGoodses($order_id,$columns = ['*'])
	{
		return OrderGoods::where('order_id',$order_id)->get($columns);
	}
    public function getShopCouponCount()
    {
        $data =  OrderInfo::select(DB::raw('sum(order_info.goods_amount) as goods_amount_count,sum(user_coupon.price) as price_count,shop.shop_name,shop.shop_id,shop.uid'))
                        ->join('user_coupon','user_coupon.user_coupon_id','=','order_info.user_coupon_id')
                        ->join('shop','shop.shop_id','=','order_info.shop_id')
                        ->groupBy('shop.shop_id')
                        ->where('order_info.user_coupon_id','>','0')
                        ->where('order_info.order_status',2)
                        ->paginate(config('admin_config.page'));
        return $data;
    }
    public function getMonthDayRank($dateym)
    {
        $ranks = OrderInfo::select(DB::raw("DATE_FORMAT(order_info.created_at,'%Y-%m-%d') as dateym,count('*') as count,SUM(order_info.goods_amount) as goods_amount,SUM(order_info.seller_shipping_fee) as seller_shipping_fee ,SUM(order_info.shipping_fee) as shipping_fee"))
                        ->join('order','order.order_id','=','order_info.order_id')
                        ->join('shop','shop.shop_id','=','order_info.shop_id')
                        ->whereRaw("DATE_FORMAT(order_info.created_at,'%Y-%m') = '".$dateym."' ")
                        ->where('order_info.order_status','2')
                        ->where('shop.shop_type',3)
                        ->orderBy('dateym','desc')
                        ->groupBy('dateym')
                        ->get();
        return $ranks;
    }
    public function monthDayRankDownload($dateym)
    {
        $ranks = OrderInfo::select(DB::raw("DATE_FORMAT(order_info.created_at,'%Y-%m-%d') as 日期,count('*') as 订单量,SUM(order_info.goods_amount) as 订单总商品额,SUM(order_info.seller_shipping_fee) as 商家出总运费 ,SUM(order_info.shipping_fee) as 买家出总运费"))
                        ->join('order','order.order_id','=','order_info.order_id')
                        ->join('shop','shop.shop_id','=','order_info.shop_id')
                        ->whereRaw("DATE_FORMAT(order_info.created_at,'%Y-%m') = '".$dateym."' ")
                        ->where('order_info.order_status','2')
                        ->where('shop.shop_type',3)
                        ->orderBy('日期','desc')
                        ->groupBy('日期')
                        ->get();
        return $ranks;
    }
    public function getRefundOrderInfos()
    {
        return OrderInfo::select(DB::raw('order_info.order_id,order_info.order_sn,order_info.total_fee,order_info.pay_id,order_info.order_status,order_info.pay_name,order_info.cancelling_time,user.nickname,user.uid,trade.fee,trade.trade_no'))
						->join('user','order_info.uid','=','user.uid')
                        ->join('shop','shop.shop_id','=','order_info.shop_id')
						->join('trade_account as trade','order_info.order_sn','=','trade.out_trade_no')
						->where('order_info.pay_id','<>',3)
                        ->where('shop.shop_type','=',3)
						->whereIn('order_info.order_status', ['3'])
						->orderBy('order_info.order_id', 'desc')
						->paginate(config('admin_config.page'));
    }
    public function getRefundOrderInfo($id)
    {
        return OrderInfo::select(DB::raw('order_info.order_id,order_info.order_sn,order_info.total_fee,order_info.pay_id,order_info.order_status,order_info.pay_name,order_info.cancelling_time,user.nickname,user.uid,trade.fee,trade.trade_no'))
						->join('user','order_info.uid','=','user.uid')
						->join('trade_account as trade','order_info.order_sn','=','trade.out_trade_no')
                        ->where('order_info.order_id', $id)
						->first();
    }
    public function updateBySn($update,$order_sn)
	{
		return OrderInfo::where('order_sn',$order_sn)->update($update);
	}
}
