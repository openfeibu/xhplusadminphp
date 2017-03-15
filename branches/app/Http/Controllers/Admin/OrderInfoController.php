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
}
