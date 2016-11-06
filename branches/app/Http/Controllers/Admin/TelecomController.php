<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Breadcrumbs, Toastr;
use App\TelecomOrder;
use App\Repositories\TelecomPackageRepositoryEloquent;
use App\Repositories\TelecomOrderRepositoryEloquent;
use App\Repositories\TelecomRealNameRepositoryEloquent;
use Excel;
use DB;
use App\Services\AdminRecordService;

class TelecomController extends BaseController
{
	protected $telecomRepositoryEloquent;
	
	protected $telecomOrderRepositoryEloquent;
	
	protected $telecomRealNameRepositoryEloquent;

	protected $adminRecordService;
	
    public function __construct(TelecomPackageRepositoryEloquent $telecomPackageRepositoryEloquent,
								TelecomOrderRepositoryEloquent $telecomOrderRepositoryEloquent,
								TelecomRealNameRepositoryEloquent $telecomRealNameRepositoryEloquent,
								AdminRecordService $adminRecordService)
	{
	    
		parent::__construct();
		$this->telecomPackageRepositoryEloquent = $telecomPackageRepositoryEloquent;
		$this->telecomOrderRepositoryEloquent = $telecomOrderRepositoryEloquent;
		$this->telecomRealNameRepositoryEloquent = $telecomRealNameRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-telecom',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('电信管理', route('admin.telecomPackage.index'));
		});
		
	}
	public function index()
	{	
		Breadcrumbs::register('admin-telecomPackage-index',function($breadcrumbs){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('套餐列表', route('admin.telecomPackage.index'));
		});
		$packages = $this->telecomPackageRepositoryEloquent->scopeQuery(function($query){
			return $query->orderBy('package_id','desc');
		})->paginate(config('admin_config.page'));

		
		
        return view('admin.telecom.index', compact('packages')); 
	}
	public function createPackage()
    {
        Breadcrumbs::register('admin-telecomPackage-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-telecom');
            $breadcrumbs->push('添加套餐', route('admin.telecomPackage.create'));
        });
        return view('admin.telecom.createPackage');
    }
	public function storePackage(Request $request)
    {
        $result = $this->telecomPackageRepositoryEloquent->create(Input::all());
        if(!$result) {
            Toastr::error('新套餐添加失败!');
            return redirect(route('admin.telecomPackage.create'));
        }
        $record = "电信管理，添加新套餐,话题内容为";
        $this->adminRecordService->record($record);
        Toastr::success('新套餐添加成功!');
        return redirect(route('admin.telecomPackage.index'));
    }
	public function editPackage($id)
	{
		Breadcrumbs::register('admin-telecomPackage-edit',function($breadcrumbs) use ($id){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('编辑套餐', route('admin.telecomPackage.edit', ['id' => $id]));
		});
		$package = $this->telecomPackageRepositoryEloquent->find($id);

        return view('admin.telecom.editPackage', compact('package'));
	}
	public function updatePackage($id)
	{
		$result = $this->telecomPackageRepositoryEloquent->update( Input::all(), $id );
        if(!$result) {
            Toastr::error("套餐更新失败");
        } else {
	        $record = "电信管理，更新套餐,套餐id为：".$id;
	        $this->adminRecordService->record($record);
            Toastr::success('套餐更新成功');
        }
        return redirect(route('admin.telecomPackage.edit', ['id' => $id]));
	}
	public function destroyPackage($id)
    {
    	$telecomPackage = $this->telecomPackageRepositoryEloquent->find($id);
        $record = "电信管理，套餐删除,套餐介绍为：".$telecomPackage->package_detail;
        $this->adminRecordService->record($record);
        $result = $this->telecomPackageRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
	public function destroyallPackage(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
        	$telecomPackage = $this->telecomPackageRepositoryEloquent->find($id);
	        $record = "电信管理，套餐删除,套餐介绍为：".$telecomPackage->package_detail;
	        $this->adminRecordService->record($record);
            $result = $this->telecomPackageRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
	public function order()
	{
		Breadcrumbs::register('admin-telecomOrder-index',function($breadcrumbs){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('订单列表', route('admin.telecomOrder.index'));
		});
		//$orders = $this->telecomOrderRepositoryEloquent->scopeQuery(function($query){
		//	return $query->orderBy('id','desc');
		//})->paginate(config('admin_config.page'));
		$orders = $this->telecomOrderRepositoryEloquent->getTelecomOrders();
        return view('admin.telecom.order', compact('orders')); 
	}
	public function editOrder($id)
	{
		Breadcrumbs::register('admin-telecomOrder-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-telecom');
            $breadcrumbs->push('编辑订单', route('admin.telecomOrder.edit', ['id' => $id]));
        });

        $order = $this->telecomOrderRepositoryEloquent->find($id);

        return view('admin.telecom.editOrder', compact('order'));
	}
	public function updateOrder(Request $request,$id)
	{
		$result = $this->telecomOrderRepositoryEloquent->update( Input::all(), $id );
        if(!$result) {
            Toastr::error("订单更新失败");
        } else {
        	$record = "电信管理，更新电信订单,订单id为：".$id;
	        $this->adminRecordService->record($record);
            Toastr::success('订单更新成功');
        }
        return redirect(route('admin.telecomOrder.edit', ['id' => $id]));
	}
	public function saveOrder(Request $request)
	{
		$ordersQuery =  $this->telecomOrderRepositoryEloquent->getTelecomOrdersExport($request);
		if($request->real == 3)
		{
			$orders = $ordersQuery->get();
		}
		else{
			$orders = $ordersQuery->where('telecom_real_name_status',$request->real)->get();
		}
		//if(!count($orders)) {
  //          Toastr::error("没有数据可以导出"); 
  //          echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";    
  //      }
  //      else{ 
        	$name = $request->startTime.'__'.$request->endTime.trans("common.telecom_real_name_status.$request->real").'电信填单';
			Excel::create($name,function($excel) use ($orders){
			  $excel->sheet('score', function($sheet) use ($orders){
				$sheet->fromArray($orders);
			  });
			})->export('xls');
		$record = "电信管理，导出电信填单excel";
	    $this->adminRecordService->record($record);
		//}
	}
	public function destroyOrder($id)
    {
    	$telecomOrder = $this->telecomOrderRepositoryEloquent->find($id);
        $record = "电信管理，电信订单删除,订单的用户id为：".$telecomOrder->uid;
        $this->adminRecordService->record($record);
        $result = $this->telecomOrderRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
	public function destroyallOrder(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
        	$telecomOrder = $this->telecomOrderRepositoryEloquent->find($id);
	        $record = "电信管理，电信订单删除,订单的用户id为：".$telecomOrder->uid;
	        $this->adminRecordService->record($record);
            $result = $this->telecomOrderRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
}
