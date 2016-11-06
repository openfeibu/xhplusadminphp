<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssociationInfoRepository;
use App\Information;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AssociationInfoRepositoryEloquent extends BaseRepository implements AssociationInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Information::class;
    }

    public function getInformationAll(){
        $informations = Information::orderBy('iid', 'desc')
                        ->leftjoin('association','information.aid','=','association.aid')
                        ->leftjoin('user','information.uid','=','user.uid')
                        ->select('information.*','user.nickname','association.aname')
                        ->paginate(config('admin_config.page'));
        return $informations;
    }

    public function getInformationOne($id){
        $information = Information::where('iid',$id)->first();
        return $information;
    }

}
