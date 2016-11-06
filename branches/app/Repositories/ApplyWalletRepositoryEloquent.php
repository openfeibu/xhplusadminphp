<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ApplyWalletRepository;
use App\ApplyWallet;
use App\User;
use App\Validators\ApplyWalletValidator;

/**
 * Class ApplyWalletRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ApplyWalletRepositoryEloquent extends BaseRepository implements ApplyWalletRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ApplyWallet::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function updateWallet ($uid,$fee)
	{

		User::where('uid',$uid)->update(['wallet' => $fee]);

		return true;
	}
}
