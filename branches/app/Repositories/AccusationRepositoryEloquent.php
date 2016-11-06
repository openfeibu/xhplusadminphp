<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AccusationRepository;
use App\Accusation;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AccusationRepositoryEloquent extends BaseRepository implements AccusationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Accusation::class;
    }

    public function getAccusationList(Request $request){
        $state = "";
        if($request->act == "review"){
            $state = "审核中";
        }elseif($request->act == "pass"){
            $state = "审核通过";
        }elseif($request->act == "fail"){
            $state = "审核失败";
        }
        $accusations = Accusation::orderBy('id', 'desc')
                            ->leftjoin('order','order.oid','=','accusation.oid')
                            ->leftjoin('user','user.uid','=','accusation.complainant_id')
                            ->where('accusation.state','=',$state)
                            ->select('accusation.*','user.nickname','order.owner_id','order.description')
                            ->paginate(config('admin_config.page'));
        if($request->act == ""){
            $accusations = Accusation::orderBy('id', 'desc')
                            ->leftjoin('order','order.oid','=','accusation.oid')
                            ->leftjoin('user','user.uid','=','accusation.complainant_id')
                            ->select('accusation.*','user.nickname','order.owner_id','order.description')
                            ->paginate(config('admin_config.page'));
        }
        return $accusations;
    }

    public function getAccusationOne($id){
        $accusation = Accusation::where('id',$id)->first();;
        return $accusation;
    }

}
