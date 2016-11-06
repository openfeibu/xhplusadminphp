<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Integral;
use Breadcrumbs, Toastr;
use App\Repositories\IntegralRepositoryEloquent;
use App\Services\AdminRecordService;

class IntegralController extends BaseController
{

	protected $integralRepositoryEloquent;
	protected $adminRecordService;
		
    public function __construct(IntegralRepositoryEloquent $integralRepositoryEloquent,
    							AdminRecordService $adminRecordService)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-integral', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('积分管理', route('admin.integral.index'));
        });

        $this->integralRepositoryEloquent = $integralRepositoryEloquent;
        $this->adminRecordService = $adminRecordService;
    }
    
	public function index(Request $request)
    {
    	Breadcrumbs::register('admin-integral-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('积分奖罚方式', route('admin.integral.index'));
		});
		$integrals = $this->integralRepositoryEloquent->getIntegralList();
        return view('admin.integral.index',compact('integrals'));
    }
	
	public function create(Request $request){
        Breadcrumbs::register('admin-integral-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-integral');
            $breadcrumbs->push('编辑积分列表', route('admin.integral.create'));
        });
        $integral = $request->session()->get('integral');
        $request->session()->put('integral','');
        return view('admin.integral.create',compact('integral'));
	}

	public function edit(Request $request){
        $integral = $this->integralRepositoryEloquent->getIntegralOne($request->id);
        $request->session()->put('integral',$integral);
		return $this->create($request);
	}

	public function destroy(Request $request)
	{
		$result = $this->integralRepositoryEloquent->delete($request->id);
		$integral = $this->integralRepositoryEloquent->find($request->id);
		$record = "积分管理，删除积分类型,积分类型名称为：".$integral->obtain_type;
        $this->adminRecordService->record($record);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

	public function destroy_all(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$integral = $this->integralRepositoryEloquent->find($id);
			$record = "积分管理，删除积分类型,积分类型名称为：".$integral->obtain_type;
       		$this->adminRecordService->record($record);
            $result = $this->integralRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function store(Request $request){
		if(!empty($request->id)){
			$integral = $this->integralRepositoryEloquent->find($request->id);
			$record = "积分管理，修改积分类型,积分类型名称为：".$integral->obtain_type;
       		$this->adminRecordService->record($record);
			DB::table('integral')
				->where('id',$request->id)
				->update([
					'obtain_type' => $request->obtain_type,
					'score' => $request->score,
				]);
			Toastr::success('更新成功');
		}else{
			$record = "积分管理，增加积分类型,积分类型名称为：".$request->obtain_type;
       		$this->adminRecordService->record($record);
			$integral = new Integral;
			$integral->obtain_type = $request->obtain_type;
			$integral->score = $request->score;
			if($integral->save()){
				Toastr::success('新增成功');
			}else{
				Toastr::success('新增成功');
			}

		}
		return redirect(route('admin.integral.index'));
	}

}
