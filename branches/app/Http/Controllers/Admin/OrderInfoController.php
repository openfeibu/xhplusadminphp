<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Breadcrumbs, Toastr;
use Excel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderInfoController extends BaseController
{
	public function __construct(){

		parent::__construct();
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-orderInfo',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('店铺管理', route('admin.shop.index'));
		});
	}

    public function index ()
    {
    	Breadcrumbs::register('admin-orderInfo-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});

		$order_infos = app('orderInfoRepositoryEloquent')->getOrderInfos();
        return view('admin.order_info.index', compact('order_infos'));
    }
	public function shopCouponCount(Request $request)
	{
		Breadcrumbs::register('admin-orderInfo-couponCount',function($breadcrumbs){
			$breadcrumbs->parent('admin-orderInfo');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});
		$shop_coupon_count = app('orderInfoRepositoryEloquent')->getShopCouponCount();

		return view('admin.order_info.shop_coupon_count', compact('shop_coupon_count'));
	}
	public function getMonthDayRank(Request $request)
	{
		Breadcrumbs::register('admin-orderInfo-getMonthDayRank',function($breadcrumbs){
			$breadcrumbs->parent('admin-orderInfo');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});
		$dateym = isset($request->dateym) && $request->dateym ? $request->dateym : date('Y-m');
		$ranks = app('orderInfoRepositoryEloquent')->getMonthDayRank($dateym);
		$count_sum = $seller_shipping_fee_sum = $shipping_fee_sum = $goods_amount_sum = 0;
		foreach ($ranks as $key => $rank) {
			$count_sum += $rank->count;
			$seller_shipping_fee_sum += $rank->seller_shipping_fee;
			$shipping_fee_sum += $rank->shipping_fee;
			$goods_amount_sum += $rank->goods_amount;
		}
		return view('admin.order_info.canteen_month_day_rank', compact('ranks','dateym','count_sum','seller_shipping_fee_sum','shipping_fee_sum','goods_amount_sum'));
	}
	public function monthDayRankDownload(Request $request)
	{
		$dateym = isset($request->dateym) && $request->dateym ? $request->dateym : date('Y-m');
		$ranks = app('orderInfoRepositoryEloquent')->monthDayRankDownload($dateym);
		$count_sum = $seller_shipping_fee_sum = $shipping_fee_sum = $goods_amount_sum = 0;
		foreach ($ranks as $key => $rank) {
			$count_sum += $rank->订单量;
			$goods_amount_sum += $rank->订单总商品额;
			$seller_shipping_fee_sum += $rank->商家出总运费;
			$shipping_fee_sum += $rank->买家出总运费;
		}
		$ranks = $ranks ? $ranks->toArray() : [];
		$ranks = array_merge($ranks,[['日期' => '','订单量' => $count_sum,'订单总商品额' => $goods_amount_sum.'元','商家出总运费' => $seller_shipping_fee_sum.'元','买家出总运费' => $shipping_fee_sum.'元']]);
		$name = $request->dateym.'饭堂每天销量列表';
		Excel::create($name,function($excel) use ($ranks){
		  	$excel->sheet('score', function($sheet) use ($ranks){
				$sheet->fromArray($ranks);
		  	});
		})->export('xls');
	}
}
