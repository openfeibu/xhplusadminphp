<?php

namespace App\Http\Controllers\Admin;

use DB;
use Input;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use Redirect;
use App\Goods;
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
			$breadcrumbs->push('设置', route('admin.statistics.goodsSaleRank'));
		});
        $goodses = Goods::select(DB::raw('goods.goods_name,goods.goods_sale_count,goods_price,shop.shop_name,goods_category.cat_name'))
                        ->leftJoin('shop','shop.shop_id','=','goods.shop_id')
                        ->leftJoin('goods_category','goods_category.cat_id','=','goods.cat_id')
                        ->orderBy('goods.goods_sale_count','desc')
                        ->take(50)
                        ->get();
        return view('admin.statistics.goods_sale_rank', compact('goodses'));
    }
}
