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
        $request->session()->put('user','');
        $request->session()->put('password',isset($user['password'])?$user['password']:'');
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
		$password = $request->session()->get('password');
		if($password != $request->password){
			$password = md5($request->password);
		}
		if(!empty($request->uid)){
			DB::table('user')
				->where('uid',$request->uid)
				->update([
					'nickname' => $request->nickname,
					'mobile_no' => $request->mobile_no,
					'password' => $password,
					'avatar_url' => $request->avatar_url  ,
					'created_ip' => $request->created_ip,
					'last_ip' => $request->last_ip,
					'ban_flag' => $request->ban_flag,
					'integral' => $request->integral,
					'today_integral' => $request->today_integral
				]);
	        $record = "用户管理，更新用户资料,用户id为：".$request->uid;
	        $this->adminRecordService->record($record);
		}else{
			$user = new User;
			$user->nickname = $request->nickname;
			$user->mobile_no = $request->mobile_no;
			$user->password = $password;
			$user->openid = DB::raw('md5(UUID())');
			$user->avatar_url = $request->avatar_url ? $request->avatar_url : config('app.api_url').'/uploads/system/avatar.png';
			$user->created_ip = $request->created_ip;
			$user->last_ip = $request->last_ip;
			$user->ban_flag = $request->ban_flag;
			$user->integral = $request->integral;
			$user->today_integral = $request->today_integral;
			$user->save();

			$record = "用户管理，增加用户";
	        $this->adminRecordService->record($record);

	        $userInfo = new UserInfo;
	        $userInfo->uid = $user->uid;
	        $userInfo->gender = '0';
	        $userInfo->college_id = '1';
	        $userInfo->enrollment_year = '2014';
	        $userInfo->save();
		}
		header("Location:/admin/user");
	}
	public function walletAccount (Request $request)
	{
		$user = $this->userRepositoryEloquent->getUserOne($request->uid,['nickname']);
		$accounts = $this->walletAccountRepositoryEloquent->getWalletAccount($request->uid);
		return view('admin.user.wallet_account',compact('user','accounts'));
	}
}
