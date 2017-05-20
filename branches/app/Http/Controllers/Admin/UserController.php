<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\User;
use App\UserInfo;
use Breadcrumbs, Toastr;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\WalletAccountRepositoryEloquent;
use App\Services\AdminRecordService;

class UserController extends BaseController
{
	protected $userRepositoryEloquent;
	protected $adminRecordService;

    public function __construct(UserRepositoryEloquent $userRepositoryEloquent,
    							AdminRecordService $adminRecordService,
    							WalletAccountRepositoryEloquent $walletAccountRepositoryEloquent)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-user', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('用户管理', route('admin.user.index'));
        });
       	$this->userRepositoryEloquent = $userRepositoryEloquent;
       	$this->walletAccountRepositoryEloquent = $walletAccountRepositoryEloquent;
       	$this->adminRecordService = $adminRecordService;
    }

	public function index(Request $request)
    {
    	Breadcrumbs::register('admin-user-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('用户管理', route('admin.user.index'));
		});
		$users = $this->userRepositoryEloquent->getUserList();
        return view('admin.user.index',compact('users'));
    }

	public function create(Request $request){
        Breadcrumbs::register('admin-user-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-user');
            $breadcrumbs->push('编辑用户', route('admin.user.create'));
        });
        $user = $request->session()->get('user');
        return view('admin.user.create',compact('user'));
	}

	public function edit(Request $request){
        $user = $this->userRepositoryEloquent->getUserOne($request->id);
        $request->session()->put('user',$user);
		return $this->create($request);
	}

	public function destroy(Request $request)
	{
		$user = $this->userRepositoryEloquent->find($request->id);
        $record = "用户管理，删除用户,删除用户id为：".$user->uid;
        $this->adminRecordService->record($record);
		$result = $this->userRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function destroy_all(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$user = $this->userRepositoryEloquent->find($id);
	        $record = "用户管理，删除用户,删除用户id为：".$user->uid;
	        $this->adminRecordService->record($record);
            $result = $this->userRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function store(Request $request){
		if($request->ban_flag == 10){
			$ban_flag = $request->old_ban_flag;
		}else{
			$ban_flag = $request->ban_flag;
		}

		if($request->is_author == 10){
			$is_author = $request->old_author;
		}else{
			$is_author = $request->is_author;
		}
		DB::table('user')
			->where('uid',$request->uid)
			->update([
				'nickname' => $request->nickname,
				'ban_flag' => $ban_flag,
			]);
		DB::table('user_info')
			->where('uid',$request->uid)
			->update([
				'is_author' => $is_author,
			]);
        $record = "用户管理，更新用户资料,用户id为：".$request->uid;
        $this->adminRecordService->record($record);
		header("Location:/admin/user");
	}
	public function walletAccount (Request $request)
	{
		$user = $this->userRepositoryEloquent->getUserOne($request->uid,['nickname']);
		$accounts = $this->walletAccountRepositoryEloquent->getWalletAccount($request->uid);
		return view('admin.user.wallet_account',compact('user','accounts'));
	}
	public function searchUser(Request $request){
		Breadcrumbs::register('admin-user-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('用户管理', route('admin.user.index'));
		});
		$users = $this->userRepositoryEloquent->getUserBySearch($request->searchUser);
        return view('admin.user.index',compact('users'));
	}

}
