<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ShippingConfigRepository;
use App\ShippingConfig;
use App\Validators\ShippingConfigValidator;

/**
 * Class ShippingConfigRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ShippingConfigRepositoryEloquent extends BaseRepository implements ShippingConfigRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ShippingConfig::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
