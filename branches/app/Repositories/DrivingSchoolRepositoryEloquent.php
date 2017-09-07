<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DrivingSchoolRepository;
use App\DrivingSchool;
use App\Validators\DrivingSchoolValidator;

/**
 * Class DrivingSchoolRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DrivingSchoolRepositoryEloquent extends BaseRepository implements DrivingSchoolRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DrivingSchool::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
