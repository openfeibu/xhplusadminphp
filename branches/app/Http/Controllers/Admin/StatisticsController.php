<?php

namespace App\Http\Controllers\Admin;

use DB;
use Input;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use Redirect;
use App\User;
use App\Goods;
use App\OrderInfo;
use App\Http\Requests;
use App\Services\HelpService;
use App\Http\Controllers\Controller;
use App\Repositories\GoodsRepositoryEloquent;

class StatisticsController extends BaseController
{
	protected $helpService;

	public function __construct(HelpService $helpService,
                                GoodsRepositoryEloquent $goodsRepositoryEloquent)
	{
		parent::__construct();
		$this->helpService = $helpService;
        $this->goodsRepositoryEloquent = $goodsRepositoryEloquent;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-statistics',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('统计', route('admin.statistics.goodsSaleRank'));
		});
	}
    public function goodsSaleRank()
    {
        Breadcrumbs::register('admin-statistics-goodsSaleRank',function($breadcrumbs){
			$breadcrumbs->parent('admin-statistics');
			$breadcrumbs->push('排行', route('admin.statistics.goodsSaleRank'));
		});
        $goodses = Goods::select(DB::raw('goods.goods_name,goods.goods_sale_count,goods_price,shop.shop_name,goods_category.cat_name'))
                        ->leftJoin('shop','shop.shop_id','=','goods.shop_id')
                        ->leftJoin('goods_category','goods_category.cat_id','=','goods.cat_id')
                        ->orderBy('goods.goods_sale_count','desc')
                        ->take(50)
                        ->get();
        return view('admin.statistics.goods_sale_rank', compact('goodses'));
    }
    public function userConsume(Request $request)
    {
        Breadcrumbs::register('admin-statistics-userConsume',function($breadcrumbs){
			$breadcrumbs->parent('admin-statistics');
			$breadcrumbs->push('店铺用户消费留存', route('admin.statistics.userConsume'));
		});
        $datemy = isset($request->datemy) && $request->datemy ? $request->datemy : date('Y-m');
        if($datemy == date('Y-m'))
        {
            $BeginDate = date('Y-m-01');
            $date = date('Y-m-d');
        }else {
            $BeginDate = date('Y-m-01', strtotime($datemy));
            $date = date('Y-m-d', strtotime("$BeginDate +1 month -1 day"));
        }
        $dates = $date_fronts = $consume_dates = $consumes = $keep_datas = [];
        $days = 3;
        for ($i=$days; $i >= 1; $i--) {
            $dates[] = date('Y-m-d',strtotime($BeginDate." -$i day"));
        }
        //当月第几天
        $j = date('j',strtotime($date));
        for ($i=$j-1; $i >= 1; $i--) {
            $dates[] = $consume_dates[] = date('Y-m-d',strtotime("$date -$i day"));
        }
        foreach($dates as $key => $value)
        {
            $datas = OrderInfo::whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') = '".$value."' ")
                                ->whereIn('pay_status',[1])
                                ->distinct('uid')
                                ->groupBy('uid')
                                ->lists('uid');
            $consumes[$value] = $datas ? $datas->toArray() : [];
        }
        foreach ($consume_dates as $k => $consume_date) {
            $keep_datas[$k]['uid'] = $consumes[$consume_date];
            $keep_datas[$k]['date'] = $consume_date;
			$weekarray = array("日","一","二","三","四","五","六");
			$keep_datas[$k]['week'] = $weekarray[date('w',strtotime($consume_date))];
            $keep_datas[$k]['count'] = count($consumes[$consume_date]);
            $keep_1 = $consumes[date('Y-m-d',strtotime("$consume_date -1 day"))];
            $keep_2 = $consumes[date('Y-m-d',strtotime("$consume_date -2 day"))];
            $keep_datas[$k]['keep_1_count'] = count(array_intersect($keep_1,$consumes[$consume_date]));
            $keep_datas[$k]['keep_2_count'] = count(array_intersect($keep_1,$keep_2,$consumes[$consume_date]));
            $keep_1_rate = count($keep_1) ? $keep_datas[$k]['keep_1_count']/count($keep_1) : 0;
            $keep_datas[$k]['keep_1_rate'] = $keep_1_rate ? (sprintf("%.6f",$keep_1_rate) * 100) .'%' : '0%';
            $keep_2_rate = count($keep_2) ? $keep_datas[$k]['keep_2_count']/count($keep_2) : 0;
            $keep_datas[$k]['keep_2_rate'] = $keep_1_rate ? (sprintf("%.6f",$keep_2_rate) * 100) .'%' : '0%';
        }
        krsort($keep_datas);
        return view('admin.statistics.user_consume', compact('keep_datas','datemy'));
    }
	public function inactives(Request $request)
	{
		Breadcrumbs::register('admin-statistics-inactives',function($breadcrumbs){
			$breadcrumbs->parent('admin-statistics');
			$breadcrumbs->push('店铺用户消费留存', route('admin.statistics.inactives'));
		});
		$number = isset($request->number) && $request->number ? $request->number : 50;
		$date = date("Y-m-d H:i:s", strtotime("-1 month"));
		$users  = User::where('last_visit','<',$date)->where('password','<>','')->orderBy('last_visit','desc')->take($number)->get();
		return view('admin.statistics.inactives', compact('users','number'));
	}
}
