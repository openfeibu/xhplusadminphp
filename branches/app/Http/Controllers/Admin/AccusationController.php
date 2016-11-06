<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Accusation;
use Breadcrumbs, Toastr;
use App\Repositories\AccusationRepositoryEloquent;
use App\Services\AdminRecordService;

class AccusationController extends BaseController
{

	protected $accusationRepositoryEloquent;
	protected $adminRecordService;
		
    public function __construct(AccusationRepositoryEloquent $accusationRepositoryEloquent,
    							AdminRecordService $adminRecordService)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-accusation', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('举报管理', route('admin.accusation.index'));
        });

        $this->accusationRepositoryEloquent = $accusationRepositoryEloquent;
        $this->adminRecordService = $adminRecordService;

    }
    
	public function index(Request $request)
    {
    	Breadcrumbs::register('admin-accusation-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('举报列表', route('admin.accusation.index'));
		});
		$accusations = $this->accusationRepositoryEloquent->getAccusationList($request);
        return view('admin.accusation.index',compact('accusations'));
    }

    public function create(Request $request){
        Breadcrumbs::register('admin-accusation-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-accusation');
            $breadcrumbs->push('编辑举报', route('admin.accusation.create'));
        });
        $accusation = $request->session()->get('accusation');
        return view('admin.accusation.create',compact('accusation'));
	}

	public function edit(Request $request){
        $accusation = $this->accusationRepositoryEloquent->getAccusationOne($request->id);
        $request->session()->put('accusation',$accusation);
		return $this->create($request);
	}

	public function destroy(Request $request)
	{	
		$accusation = $this->accusationRepositoryEloquent->find($request->id);
		$record = "删除举报，订单id为：".$accusation->oid."，举报内容为：".$accusation->type;
        $this->adminRecordService->record($record);
		$result = $this->accusationRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function destroy_all(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$accusation = $this->accusationRepositoryEloquent->find($id);
			$record = "删除举报，订单id为：".$accusation->oid."，举报内容为：".$accusation->type;
	        $this->adminRecordService->record($record);
            $result = $this->accusationRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function store(Request $request){
		DB::table('accusation')
			->where('id',$request->id)
			->update([
				'state' => $request->state
			]);
		$accusation = $this->accusationRepositoryEloquent->find($request->id);
		$record = "审核举报，订单id为：".$accusation->oid."，举报状态：".$request->state;
        $this->adminRecordService->record($record);
		header("Location:/admin/accusation");
	}

}
