<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DrivingSchoolEnrollmentRepository;
use App\Models\DrivingSchoolEnrollment;
use App\Validators\DrivingSchoolEnrollmentValidator;

/**
 * Class DrivingSchoolEnrollmentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DrivingSchoolEnrollmentRepositoryEloquent extends BaseRepository implements DrivingSchoolEnrollmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DrivingSchoolEnrollment::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
