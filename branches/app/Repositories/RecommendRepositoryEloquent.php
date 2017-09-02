<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RecommendRepository;
use App\Recommend;
use App\Validators\RecommendValidator;

/**
 * Class RecommendRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RecommendRepositoryEloquent extends BaseRepository implements RecommendRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Recommend::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
