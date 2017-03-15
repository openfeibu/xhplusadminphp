<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GoodsRepository;
use App\Goods;
use App\Validators\GoodsRepositoryValidator;

/**
 * Class GoodsRepositoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GoodsRepositoryEloquent extends BaseRepository implements GoodsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Goods::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

	public function getGoods ($where,$columns)
	{
		$goods = Goods::where($where)->first($columns);
		return 	$goods;			
	}
}
