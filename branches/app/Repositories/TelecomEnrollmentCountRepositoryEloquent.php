<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TelecomEnrollmentCountRepository;
use App\TelecomEnrollmentCount;
use App\Validators\TelecomEnrollmentCountValidator;

/**
 * Class TelecomEnrollmentCountRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TelecomEnrollmentCountRepositoryEloquent extends BaseRepository implements TelecomEnrollmentCountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TelecomEnrollmentCount::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
