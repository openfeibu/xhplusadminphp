<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminRecordRepository;
use App\AdminRecord;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminRecordRepositoryEloquent extends BaseRepository implements AdminRecordRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRecord::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
