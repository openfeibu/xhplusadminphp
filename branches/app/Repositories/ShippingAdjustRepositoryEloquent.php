<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ShippingAdjustRepository;
use App\ShippingAdjust;
use App\Validators\ShippingAdjustValidator;

/**
 * Class ShippingAdjustRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ShippingAdjustRepositoryEloquent extends BaseRepository implements ShippingAdjustRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ShippingAdjust::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
