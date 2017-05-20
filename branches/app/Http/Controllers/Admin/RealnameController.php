<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Admin\AdminUser\CreateRequest;
use App\Http\Requests\Admin\AdminUser\UpdateRequest;
use Breadcrumbs, Toastr;
use DB;
use App\Real_name_auth;
use App\Userinfo;
use App\Repositories\RealnameRepository;
use App\Services\MessageService;
use App\RealnameAuth;
use App\Services\PushService;
use App\Services\SMSService;
use Illuminate\Support\Facades\Session;
use App\Services\AdminRecordService;

class RealnameController extends BaseController
{
	protected $realnameRepository;

	protected $messageService;

	protected $pushService;

	protected $adminRecordService;

    public function __construct(MessageService $messageService,
    							RealnameRepository $realnameRepository,
    							PushService $pushService,
								SMSService $smsService,
    							AdminRecordService $adminRecordService)
    {
        parent::__construct();

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-user', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('实名管理', route('admin.user.real'));
        });

		$this->realnameRepository = $realnameRepository;

		$this->messageService = $messageService;

		$this->pushService = $pushService;

		$this->adminRecordService = $adminRecordService;

		$this->smsService = $smsService;
    }
	public function index(Request $request)
    {

		Breadcrumbs::register('admin-user-real',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('实名列表', route('admin.user.real'));
		});
		$realnames = $this->realnameRepository->real_list_all();
		if($request->act == 'pass'){
			$realnames = $this->realnameRepository->real_list_pass();
		}elseif($request->act == 'fail'){
			$realnames = $this->realnameRepository->real_list_fail();
		}
        return view('admin.user.real', compact('realnames'));
    }

	public function real_create(Request $request){
		Breadcrumbs::register('admin-user-real_create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-user');
            $breadcrumbs->push('添加实名用户', route('admin.user.real_create'));
        });
		$form_data = $request->session()->get('form_data');
		if(!empty($request->error1)){
			echo "<script>alert(".$request->error1.")</script>";
		}
        return view('admin.user.real_create',compact('form_data'));
	}

	public function real_edit(Request $request)
    {
        Breadcrumbs::register('admin-user-real_edit', function ($breadcrumbs){
            $breadcrumbs->parent('admin-user');
            $breadcrumbs->push('编辑实名用户', route('admin.user.real_edit', ['id' => $id]));
        });
		$realname = $this->realnameRepository->real_edit($request,$request->id);
		return redirect('admin/user/real_create');
    }

	public function real_destroy(Request $request){
		$realname = RealnameAuth::where('id', $request->id)->first();
        $record = "用户实名管理，删除实名用户,用户id为：".$realname->uid;
        $this->adminRecordService->record($record);
		$result = RealnameAuth::where('id', $request->id)->delete();
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function real_destroy_all(Request $request){
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$realname = RealnameAuth::where('id', $id)->first();
       		$record = "用户实名管理，删除实名用户,用户id为：".$realname->uid;
       		$this->adminRecordService->record($record);
            $result = RealnameAuth::where('id', $id)->delete();
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function real_pass(Request $request){
		if(empty($request->username)){
			Toastr::error('名字不能为空!');
        	return redirect('admin/user/real');
		}
		Userinfo::where('uid',$request->uid)->update([
			"realname" => $request->username,
		]);
		RealnameAuth::where('uid',$request->uid)->update([
			"status" => "passed",
		]);
		$content = "你的实名已经通过,开启你的玩转任务之旅吧,如果还未显示实名成功，请注销再次登录";
		$this->messageService->SystemMessage2SingleOne($request->uid, $content);
		$this->pushService->PushUserTokenDevice("校汇实名通知", $content, $request->uid);

   		$record = "用户实名管理，通过实名用户,用户id为：".$request->uid;
   		$this->adminRecordService->record($record);

		$user = $this->userRepositoryEloquent->getUserOne($request->uid,['nickname','mobile_no']);

		$rst = $this->smsService->sendSMS($user->mobile_no,$type = 'real_name_true',$data = ['sms_template_code' => config('sms.real_name_true')]);

		header("Location:real");
	}

	public function real_fail(Request $request){
		Session::put('uid',$request->uid);
		if(empty($request->beizhu)){
			Toastr::error('备注不能为空!');
        	return redirect('admin/user/real');
		}
		RealnameAuth::where('uid',$request->uid)->update([
			"status" => "invalid",
		]);
		Userinfo::where('uid',$request->uid)->update([
			"realname" => "",
		]);

		$deleted_real = RealnameAuth::where('uid', $request->uid)->delete();
		if($deleted_real){
			$content = "你的实名不通过，原因是：".$request->beizhu;
			$this->messageService->SystemMessage2SingleOne($request->uid, $content);
			$this->pushService->PushUserTokenDevice("校汇实名通知", $content, $request->uid);
			$record = "用户实名管理，驳回实名用户,用户id为：".$request->uid."原因是:".$request->beizhu;
   			$this->adminRecordService->record($record);
			$rst = $this->smsService->sendSMS($user->mobile_no,$type = 'real_name_error',$data = ['sms_template_code' => config('sms.real_name_true')]);
			return redirect('admin/user/real');
		}
	}

}
