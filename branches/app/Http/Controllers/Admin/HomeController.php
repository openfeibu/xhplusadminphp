<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use DB;
use App\User;
use App\Shop;
use App\Order;
use App\OrderInfo;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

		$beginThisweek = mktime(0,0,0,date('m'),date('d')-date('w'),date('Y'));

		$endThisweek = mktime(23,59,59,date('m'),date('d')-date('w')+7,date('Y'));

	    $data['active_user_this_week_count'] = User::whereBetween('last_visit',[dtime($beginThisweek),dtime($endThisweek)])->count();

	    $data['new_user_this_week_count'] = User::whereBetween('created_at',[dtime($beginThisweek),dtime($endThisweek)])->count();

	    $data['order_info_this_week_count'] = OrderInfo::whereBetween('created_at',[dtime($beginThisweek),dtime($endThisweek)])->where('order_status',2)->count();

	    $data['order_this_week_count'] = Order::whereBetween('created_at',[dtime($beginThisweek),dtime($endThisweek)])->where('status','completed')->count();



		$beginThismonth = mktime(0,0,0,date('m'),1,date('Y'));

		$endThismonth = mktime(23,59,59,date('m'),date('t'),date('Y'));

		$data['active_user_this_month_count'] = User::whereBetween('last_visit',[dtime($beginThismonth),dtime($endThismonth)])->count();

		$data['new_user_this_month_count'] = User::whereBetween('created_at',[dtime($beginThismonth),dtime($endThismonth)])->count();

		$data['order_info_this_month_count'] = OrderInfo::whereBetween('created_at',[dtime($beginThismonth),dtime($endThismonth)])->where('order_status',2)->count();

		$data['order_this_month_count'] = Order::whereBetween('created_at',[dtime($beginThismonth),dtime($endThismonth)])->where('status','completed')->count();

		$data['wallet'] = User::select(DB::raw('SUM(wallet) as wallet'))->value('wallet');

		$data['service_fee'] = Order::select(DB::raw('SUM(service_fee) as service_fee'))->where('status','completed')->value('service_fee');

		$data['shop_trade'] = Shop::select(DB::raw('SUM(income) as income'))->value('income');

        return view('admin.home')->with('data',$data);
    }
	public function getOrderInfosCharts()
	{
		
		return [
			'rows1' => [
				'name' => '第一条',
				'data' => [
					0 => 10,
					1 => 20,
					2 => 30,
					3 => 40,
					4 => 50,
					5 => 200,
					6 => 70,
					7 => 100,
					8 => 90,
					9 => 200,
					10 => 100,
					11 => 60,
				],
			],
			'rows2' => [
				'name' => '第二条',
				'data' => [
					0 => 10,
					1 => 20,
					2 => 30,
					3 => 40,
					4 => 50,
					5 => 200,
					6 => 70,
					7 => 100,
					8 => 90,
					9 => 200,
					10 => 100,
					11 => 60,
				],
			],
		 ];
	}
}
