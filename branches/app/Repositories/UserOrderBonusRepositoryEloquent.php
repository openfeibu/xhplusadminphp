<?php

namespace App\Repositories;

use DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserOrderBonusRepository;
use App\UserOrderBonus;
use App\Validators\UserOrderBonusValidator;

/**
 * Class UserOrderBonusRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserOrderBonusRepositoryEloquent extends BaseRepository implements UserOrderBonusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserOrderBonus::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function getUserOrderBonuses()
    {
        return UserOrderBonus::select(DB::raw('user_order_bonus.*,user.nickname,user_info.realname'))
                               ->join('user','user.uid','=','user_order_bonus.uid')
                               ->leftJoin('user_info','user_info.uid','=','user_order_bonus.uid')
                               ->orderBy('id','desc')
                               ->paginate(config('admin_config.page'));


    }
}
