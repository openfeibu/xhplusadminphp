<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LossRepository;
use DB;
use App\Loss;
use App\LossCategory;
use App\Validators\LossValidator;

/**
 * Class LossRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LossRepositoryEloquent extends BaseRepository implements LossRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Loss::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getLosses()
    {
        return Loss::select(DB::raw('loss.college_id,loss.uid,loss.content,loss.mobile,loss.type,loss.img,loss.thumb,loss.created_at,loss.loss_id,loss_category.cat_name,loss_category.cat_id,user.nickname,user.avatar_url'))
                           ->orderBy('loss.loss_id','desc')
                           ->rightJoin('user','user.uid','=','loss.uid')
                           ->rightJoin('loss_category','loss_category.cat_id','=','loss.cat_id')
                           ->paginate(config('admin_config.page'));
    }
}
