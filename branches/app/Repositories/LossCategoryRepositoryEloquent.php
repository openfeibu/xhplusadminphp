<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LossCategoryRepository;
use App\LossCategory;
use App\Validators\LossCategoryValidator;

/**
 * Class LossCategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LossCategoryRepositoryEloquent extends BaseRepository implements LossCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LossCategory::class;
    }
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
