<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\IntegralRepository;
use App\Integral;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class IntegralRepositoryEloquent extends BaseRepository implements IntegralRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Integral::class;
    }

    public function getIntegralList(){
        $integrals = Integral::orderBy('id', 'asc')->paginate(config('admin_config.page'));
        return $integrals;
    }

    public function getIntegralOne($id){
        $integral = Integral::where('id',$id)->first();;
        return $integral;
    }

}
