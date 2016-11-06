<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AlipayRefundRepository;
use App\Repositories\TradeAccountRepositoryEloquent;
use App\AlipayRefund;

/**
 * Class AlipayRefundRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AlipayRefundRepositoryEloquent extends BaseRepository implements AlipayRefundRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AlipayRefund::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
