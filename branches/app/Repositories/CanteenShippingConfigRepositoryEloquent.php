<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CanteenShippingConfigRepository;
use App\CanteenShippingConfig;
use App\Validators\CanteenShippingConfigValidator;

/**
 * Class CanteenShippingConfigRepositoryEloquent
 * @package namespace App\Repositories;
 */
class CanteenShippingConfigRepositoryEloquent extends BaseRepository implements CanteenShippingConfigRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CanteenShippingConfig::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
