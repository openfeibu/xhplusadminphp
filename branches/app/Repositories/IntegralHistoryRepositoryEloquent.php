<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IntegralHistoryRepository;
use App\Integral_history;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class IntegralHistoryRepositoryEloquent extends BaseRepository implements IntegralHistoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Integral_history::class;
    }

    public function getIntegralHistoryList($uid){
        $integral_history = Integral_history::orderBy('id', 'desc')
                                    ->leftjoin('user','user.uid','=','integral_history.uid')
                                    ->leftjoin('integral','integral.id','=','integral_history.integral_id')
                                    ->select('integral_history.*','user.nickname','integral.obtain_type')
                                    ->paginate(config('admin_config.page'));
        if(!empty($uid)){
            $integral_history = Integral_history::orderBy('id', 'desc')
                                    ->leftjoin('user','user.uid','=','integral_history.uid')
                                    ->leftjoin('integral','integral.id','=','integral_history.integral_id')
                                    ->where('integral_history.uid',$uid)
                                    ->orwhere('user.nickname',$uid)
                                    ->select('integral_history.*','user.nickname','integral.obtain_type')
                                    ->paginate(config('admin_config.page'));
        }
        return $integral_history;
    }

    public function getIntegralHistoryOne($id){
        $integral_history = Integral_history::where('id',$id)->first();;
        return $integral_history;
    }

}
