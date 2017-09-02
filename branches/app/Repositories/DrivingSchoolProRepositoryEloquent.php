<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DrivingSchoolProRepository;
use App\DrivingSchoolPro;
use App\Validators\DrivingSchoolProValidator;

/**
 * Class DrivingSchoolProRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DrivingSchoolProRepositoryEloquent extends BaseRepository implements DrivingSchoolProRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DrivingSchoolPro::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function get($ds_id)
    {
        return DrivingSchoolPro::where('ds_id',$ds_id)->orderBy('product_id','asc')->get();
    }
}
