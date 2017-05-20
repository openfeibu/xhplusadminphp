<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GameRepository;
use DB;
use App\Game;
use App\Coupon;
use App\GameCouponPrize;
use App\GameUserPrize;
use App\Validators\GameValidator;

/**
 * Class GameRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GameRepositoryEloquent extends BaseRepository implements GameRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Game::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function getPrizes()
    {
        $prizes = GameCouponPrize::select(DB::raw('coupon.*,game_coupon_prize.prize_id,game_coupon_prize.prize_value'))
								->Join('coupon','coupon.coupon_id','=','game_coupon_prize.coupon_id')
								->OrderBy('prize_id','asc')->get();

        foreach ($prizes as $key => $prize) {
			$prize->price_desc = '满'.$prize->min_price.'减'.$prize->price;
		}
		return $prizes;
    }
    public function prizesRunEdit($where,$update)
    {
        return GameCouponPrize::where($where)->update($update);
    }
    public function getUserPrizes($where)
	{
		return GameUserPrize::where($where)
                            ->Join('user','user.uid','=','game_user_prize.uid')
                            ->orderBy('game_user_prize.user_prize_id','desc')
                            ->paginate(config('admin_config.page'));
	}

}
