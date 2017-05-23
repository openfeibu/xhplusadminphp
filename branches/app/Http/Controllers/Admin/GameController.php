<?php

namespace App\Http\Controllers\Admin;

use Input;
use App\Http\Requests;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use App\Repositories\GameRepositoryEloquent;

class GameController extends BaseController
{
    public function __construct(GameRepositoryEloquent $gameRepositoryEloquent){
		parent::__construct();
        $this->gameRepositoryEloquent =  $gameRepositoryEloquent;
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
        $games = $this->gameRepositoryEloquent->orderBy('id','asc')->paginate(config('admin_config.page'), $columns = ['*']);
        return view('admin.game.index', compact('games'));
    }
    public function prizes(Request $request)
    {
        Breadcrumbs::register('admin-game-prizes',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('游戏列表', route('admin.game.index'));
		});
        $prizes = $this->gameRepositoryEloquent->getPrizes();
        return view('admin.game.prizes', compact('prizes'));
    }
    public function prizesRunEdit(Request $request)
    {
        $prize_ids = Input::get('prize_id');
        $prize_values = Input::get('prize_value');
        foreach($prize_values as $key => $val)
        {
            $this->gameRepositoryEloquent->prizesRunEdit(['prize_id' => $prize_ids[$key]],['prize_value' => $val]);
        }
        return redirect(route('admin.game.prizes'));
    }
    public function userPrizes(Request $request)
    {
        Breadcrumbs::register('admin-game-user_prizes',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('游戏列表', route('admin.game.index'));
		});
        $game_id = $request->id;
        $user_prizes = $this->gameRepositoryEloquent->getUserPrizes(['game_id' => $game_id]);

        return view('admin.game.user_prizes', compact('user_prizes','game_id'));
    }
}
