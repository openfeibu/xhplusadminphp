<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderBonusSettingRepository;
use App\OrderBonusSetting;
use App\Validators\OrderBonusSettingValidator;

/**
 * Class OrderBonusSettingRepositoryEloquent
 * @package namespace App\Repositories;
 */
class OrderBonusSettingRepositoryEloquent extends BaseRepository implements OrderBonusSettingRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderBonusSetting::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
