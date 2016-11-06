<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\User;
use App\DeviceToken;
use DB;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function getUserList(){
        $users = User::orderBy('uid', 'desc')->paginate(config('admin_config.page'));
        return $users;
    }
	
    public function getUserOne($id){
        $user = User::where('uid',$id)->first();
        return $user;
    }

	public function getUserWallet($id){
        $user = User::select(DB::raw('wallet'))->where('uid',$id)->first();
        return $user->wallet;
    }
    /**
     * 获取指定用户的device_token
     */
    public function getDeviceTokenByUserID($user_id)
    {
        return DeviceToken::select(DB::raw('device_token.uid, device_token.platform, device_token.device_token'))
                          ->join('user', 'device_token.uid', '=', 'user.uid')
                          ->where('device_token.uid', '=', $user_id)
                          ->orderBy('device_token.created_at', 'desc')
                          ->first();
    }

}
