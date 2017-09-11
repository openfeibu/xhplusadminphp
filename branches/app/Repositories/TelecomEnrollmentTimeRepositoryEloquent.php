<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TelecomEnrollmentTimeRepository;
use App\TelecomEnrollmentTime;
use App\Validators\TelecomEnrollmentTimeValidator;

/**
 * Class TelecomEnrollmentTimeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TelecomEnrollmentTimeRepositoryEloquent extends BaseRepository implements TelecomEnrollmentTimeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TelecomEnrollmentTime::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
