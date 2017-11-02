<?php

namespace App\Http\Controllers\Admin;

use DB;
use Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use App\Repositories\OrderBonusSettingRepositoryEloquent;

class ShopController extends BaseController
{
	protected $shopRepositoryEloquent ;
    protected $adminRecordService;

    public function __construct(OrderBonusSettingRepositoryEloquent $orderBonusSettingRepositoryEloquent
    {

		parent::__construct();
		$this->orderBonusSettingRepositoryEloquent = $orderBonusSettingRepositoryEloquent;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-orderBonusSetting',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('奖励金管理', route('admin.orderBonusSetting.index'));
		});
	}
	public function index()
    {

		Breadcrumbs::register('admin-orderBonusSetting-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('奖励金列表', route('admin.orderBonusSetting.index'));
		});

		$order_bonus_setting = $this->orderBonusSettingRepositoryEloquent->orderBy('id','asc')->paginate(config('admin_config.page'), $columns = ['*']);

        return view('admin.orderBonus.index', compact('order_bonus_setting'));
    }
}
