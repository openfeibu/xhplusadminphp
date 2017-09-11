<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TelecomEnrollmentRepository;
use App\TelecomEnrollment;
use App\Validators\TelecomEnrollmentValidator;

/**
 * Class TelecomEnrollmentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TelecomEnrollmentRepositoryEloquent extends BaseRepository implements TelecomEnrollmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TelecomEnrollment::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function getEnrollments()
    {
        return TelecomEnrollment::orderBy('date','desc')
                                ->orderBy('time_start','asc')
                                ->select('*')
                                ->paginate(config('admin_config.page'));
    }
}
