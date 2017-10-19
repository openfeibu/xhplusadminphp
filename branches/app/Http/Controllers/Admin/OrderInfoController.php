<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Breadcrumbs, Toastr;
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
		$ranks = app('orderInfoRepositoryEloquent')->getMonthDayRank();
		return view('admin.order_info.canteen_month_day_rank', compact('ranks'));
	}
}
