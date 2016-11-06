<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Integral_history;
use Breadcrumbs, Toastr;
use App\Repositories\IntegralHistoryRepositoryEloquent;
use App\Repositories\IntegralRepositoryEloquent;
use App\Services\AdminRecordService;

class IntegralHistoryController extends BaseController
{

	protected $integralHistoryRepositoryEloquent;

	protected $integralRepositoryEloquent;
	protected $adminRecordService;
		
    public function __construct(IntegralHistoryRepositoryEloquent $integralHistoryRepositoryEloquent
    							,IntegralRepositoryEloquent $integralRepositoryEloquent,
    							AdminRecordService $adminRecordService)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-integral_history', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('积分管理', route('admin.integral_history.index'));
        });

        $this->integralHistoryRepositoryEloquent = $integralHistoryRepositoryEloquent;

        $this->integralRepositoryEloquent = $integralRepositoryEloquent;
        $this->adminRecordService = $adminRecordService;
    }
    
	public function index(Request $request)
    {
    	Breadcrumbs::register('admin-integral_history-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('编辑用户积分历史', route('admin.integral_history.index'));
		});
		$integral_history = $this->integralHistoryRepositoryEloquent->getIntegralHistoryList($request->uid);
        return view('admin.integral.history',compact('integral_history'));
    }
	
	public function create(Request $request){
        Breadcrumbs::register('admin-integral_history-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-integral_history');
            $breadcrumbs->push('编辑历史积分', route('admin.integral_history.create'));
        });
        $integral_history = $request->session()->get('integral_history');
        $integrals = $this->integralRepositoryEloquent->getIntegralList();
        $request->session()->put('integral_history','');
        return view('admin.integral.history_create',compact('integral_history','integrals'));
	}

	public function edit(Request $request){
        $integral_history = $this->integralHistoryRepositoryEloquent->getIntegralHistoryOne($request->id);
        $request->session()->put('integral_history',$integral_history);
		return $this->create($request);
	}

	public function destroy(Request $request)
	{
		$integralHistory = $this->integralHistoryRepositoryEloquent->find($request->id);
		$record = "积分管理，删除积分历史,积分历史的用户id为：".$integralHistory->uid;
        $this->adminRecordService->record($record);
        $result = $this->integralHistoryRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function destroy_all(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$integralHistory = $this->integralHistoryRepositoryEloquent->find($id);
			$record = "积分管理，删除积分历史,积分历史的用户id为：".$integralHistory->uid;
      		$this->adminRecordService->record($record);
            $result = $this->integralHistoryRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

}
