<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;


class GameController extends BaseController
{
    public function __construct(){
		parent::__construct();
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-game',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('游戏活动', route('admin.game.index'));
		});
	}
	public function index()
    {
		Breadcrumbs::register('admin-game-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('游戏列表', route('admin.game.index'));
		});
        return view('admin.game.index');
    }
}
