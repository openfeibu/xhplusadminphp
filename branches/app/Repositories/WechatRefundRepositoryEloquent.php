<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\WechatRefundRepository;
use App\WechatRefund;
use App\Validators\WechatRefundValidator;

/**
 * Class WechatRefundRepositoryEloquent
 * @package namespace App\Repositories;
 */
class WechatRefundRepositoryEloquent extends BaseRepository implements WechatRefundRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WechatRefund::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
