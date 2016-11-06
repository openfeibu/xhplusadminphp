<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssociationActivityRepository;
use App\Activity;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AssociationActivityRepositoryEloquent extends BaseRepository implements AssociationActivityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Activity::class;
    }

    public function getActivityAll(){
        $informations = Activity::orderBy('actid', 'desc')
                        ->leftjoin('association','association.aid','=','activity.aid')
                        ->leftjoin('user','user.uid','=','activity.uid')
                        ->select('activity.*','user.nickname','association.aname')
                        ->paginate(config('admin_config.page'));
        return $informations;
    }

    public function getActivityOne($id){
        $information = Activity::where('actid',$id)->first();
        return $information;
    }

}
