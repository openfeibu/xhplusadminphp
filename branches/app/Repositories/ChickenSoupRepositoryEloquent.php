<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ChickenSoupRepository;
use App\ChickenSoup;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ChickenSoupRepositoryEloquent extends BaseRepository implements ChickenSoupRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ChickenSoup::class;
    }

    public function getChickenSoupList(Request $request){
        $chickenSoup = ChickenSoup::select(DB::raw('chicken_soup.*,user.nickname'))
                            ->leftJoin('user','chicken_soup.uid','=','user.uid')
                            ->whereNull('deleted_at')
                            ->orderBy('csid', 'desc')
                            ->paginate(config('admin_config.page'));
        if($request->act==1){
            $chickenSoup = ChickenSoup::select(DB::raw('chicken_soup.*,user.nickname'))
                            ->leftJoin('user','chicken_soup.uid','=','user.uid')
                            ->whereNull('deleted_at')
                            ->where('status',1)
                            ->orderBy('csid', 'desc')
                            ->paginate(config('admin_config.page'));
        }else if($request->act==2){
            $chickenSoup = ChickenSoup::select(DB::raw('chicken_soup.*,user.nickname'))
                            ->leftJoin('user','chicken_soup.uid','=','user.uid')
                            ->whereNull('deleted_at')
                            ->whereIn('status', [0, 3])
                            ->orderBy('csid', 'desc')
                            ->paginate(config('admin_config.page'));
        }

        return $chickenSoup;
    }

    public function getChickenSoupOne($id){
        $chickenSoup = ChickenSoup::where('csid',$id)->whereNull('deleted_at')->first();;
        return $chickenSoup;
    }

    public function getVerifyList($page){
        $getVerifyList = ChickenSoup::select(DB::raw('chicken_soup.background_url,chicken_soup.title,chicken_soup.status,chicken_soup.created_at,user.nickname,chicken_soup.uid,chicken_soup.csid'))
                                    ->leftJoin('user','chicken_soup.uid','=','user.uid')
                                    ->whereIn('status', [0, 3])
                                    //->where('chicken_soup.uid', '<>',0)
                                    ->whereNull('chicken_soup.deleted_at')
                                    ->orderBy('chicken_soup.status','desc')
                                    ->orderBy('chicken_soup.csid','desc')
                                    ->skip(5 * $page - 5)
                                    ->take(5)
                                    ->get();
        $countList = ChickenSoup::select(DB::raw('chicken_soup.csid'))
                                    ->whereIn('status', [0, 3])
                                    //->where('chicken_soup.uid', '<>',0)
                                    ->whereNull('chicken_soup.deleted_at')
                                    ->get();
        return [
            'countList' => count($countList) ,
            'verifyList' => $getVerifyList
        ];
    }
}
