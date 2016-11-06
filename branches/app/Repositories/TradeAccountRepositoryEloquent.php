<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TradeAccountRepository;
use App\TradeAccount;
use App\Validators\TradeAccountValidator;

/**
 * Class TradeAccountRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TradeAccountRepositoryEloquent extends BaseRepository implements TradeAccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TradeAccount::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
