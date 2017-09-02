<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EducationEnrollmentRepository;
use App\Models\EducationEnrollment;
use App\Validators\EducationEnrollmentValidator;

/**
 * Class EducationEnrollmentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EducationEnrollmentRepositoryEloquent extends BaseRepository implements EducationEnrollmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EducationEnrollment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
