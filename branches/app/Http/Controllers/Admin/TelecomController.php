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
use App\Repositories\TelecomEnrollmentRepositoryEloquent;
use App\Repositories\TelecomEnrollmentCountRepositoryEloquent;
use App\Repositories\TelecomEnrollmentTimeRepositoryEloquent;
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
								TelecomEnrollmentRepositoryEloquent $telecomEnrollmentRepositoryEloquent,
								TelecomEnrollmentCountRepositoryEloquent $telecomEnrollmentCountRepositoryEloquent,
								TelecomEnrollmentTimeRepositoryEloquent $telecomEnrollmentTimeRepositoryEloquent,
								AdminRecordService $adminRecordService)
	{

		parent::__construct();
		$this->telecomPackageRepositoryEloquent = $telecomPackageRepositoryEloquent;
		$this->telecomOrderRepositoryEloquent = $telecomOrderRepositoryEloquent;
		$this->telecomRealNameRepositoryEloquent = $telecomRealNameRepositoryEloquent;
		$this->telecomEnrollmentRepositoryEloquent = $telecomEnrollmentRepositoryEloquent;
		$this->telecomEnrollmentCountRepositoryEloquent = $telecomEnrollmentCountRepositoryEloquent;
		$this->telecomEnrollmentTimeRepositoryEloquent = $telecomEnrollmentTimeRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-telecom',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('????????????', route('admin.telecomPackage.index'));
		});

	}
	public function index()
	{
		Breadcrumbs::register('admin-telecomPackage-index',function($breadcrumbs){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('????????????', route('admin.telecomPackage.index'));
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
            $breadcrumbs->push('????????????', route('admin.telecomPackage.create'));
        });
        return view('admin.telecom.createPackage');
    }
	public function storePackage(Request $request)
    {
        $result = $this->telecomPackageRepositoryEloquent->create(Input::all());
        if(!$result) {
            Toastr::error('?????????????????????!');
            return redirect(route('admin.telecomPackage.create'));
        }
        $record = "??????????????????????????????,???????????????";
        $this->adminRecordService->record($record);
        Toastr::success('?????????????????????!');
        return redirect(route('admin.telecomPackage.index'));
    }
	public function editPackage($id)
	{
		Breadcrumbs::register('admin-telecomPackage-edit',function($breadcrumbs) use ($id){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('????????????', route('admin.telecomPackage.edit', ['id' => $id]));
		});
		$package = $this->telecomPackageRepositoryEloquent->find($id);

        return view('admin.telecom.editPackage', compact('package'));
	}
	public function updatePackage($id)
	{
		$result = $this->telecomPackageRepositoryEloquent->update( Input::all(), $id );
        if(!$result) {
            Toastr::error("??????????????????");
        } else {
	        $record = "???????????????????????????,??????id??????".$id;
	        $this->adminRecordService->record($record);
            Toastr::success('??????????????????');
        }
        return redirect(route('admin.telecomPackage.edit', ['id' => $id]));
	}
	public function destroyPackage($id)
    {
    	$telecomPackage = $this->telecomPackageRepositoryEloquent->find($id);
        $record = "???????????????????????????,??????????????????".$telecomPackage->package_detail;
        $this->adminRecordService->record($record);
        $result = $this->telecomPackageRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
	public function destroyallPackage(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '??????????????????']);
        }

        foreach($ids as $id){
        	$telecomPackage = $this->telecomPackageRepositoryEloquent->find($id);
	        $record = "???????????????????????????,??????????????????".$telecomPackage->package_detail;
	        $this->adminRecordService->record($record);
            $result = $this->telecomPackageRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
	public function order()
	{
		Breadcrumbs::register('admin-telecomOrder-index',function($breadcrumbs){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('????????????', route('admin.telecomOrder.index'));
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
            $breadcrumbs->push('????????????', route('admin.telecomOrder.edit', ['id' => $id]));
        });

        $order = $this->telecomOrderRepositoryEloquent->find($id);

        return view('admin.telecom.editOrder', compact('order'));
	}
	public function updateOrder(Request $request,$id)
	{
		$result = $this->telecomOrderRepositoryEloquent->update( Input::all(), $id );
        if(!$result) {
            Toastr::error("??????????????????");
        } else {
        	$record = "?????????????????????????????????,??????id??????".$id;
	        $this->adminRecordService->record($record);
            Toastr::success('??????????????????');
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
  //          Toastr::error("????????????????????????");
  //          echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
  //      }
  //      else{
        	$name = $request->startTime.'__'.$request->endTime.trans("common.telecom_real_name_status.$request->real").'????????????';
			Excel::create($name,function($excel) use ($orders){
			  $excel->sheet('score', function($sheet) use ($orders){
				$sheet->fromArray($orders);
			  });
			})->export('xls');
		$record = "?????????????????????????????????excel";
	    $this->adminRecordService->record($record);
		//}
	}
	public function destroyOrder($id)
    {
    	$telecomOrder = $this->telecomOrderRepositoryEloquent->find($id);
        $record = "?????????????????????????????????,???????????????id??????".$telecomOrder->uid;
        $this->adminRecordService->record($record);
        $result = $this->telecomOrderRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
	public function destroyallOrder(Request $request)
    {
        if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '??????????????????']);
        }

        foreach($ids as $id){
        	$telecomOrder = $this->telecomOrderRepositoryEloquent->find($id);
	        $record = "?????????????????????????????????,???????????????id??????".$telecomOrder->uid;
	        $this->adminRecordService->record($record);
            $result = $this->telecomOrderRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }
	public function enrollmentTime(Request $request)
	{
		Breadcrumbs::register('admin-telecomEnroll-time',function($breadcrumbs){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('', route('admin.telecomEnroll.time'));
		});

		$times = $this->telecomEnrollmentTimeRepositoryEloquent->all();

		return view('admin.telecom.time', compact('times'));
	}
	public function enrollments(Request $request)
	{
		Breadcrumbs::register('admin-telecomEnroll-enrollments',function($breadcrumbs){
			$breadcrumbs->parent('admin-telecom');
			$breadcrumbs->push('', route('admin.telecomEnroll.enrollments'));
		});
		$date = date("Y-m-d",strtotime("+1 day"));
		$enrollments = $this->telecomEnrollmentRepositoryEloquent->getEnrollments();
		return view('admin.telecom.enrollments', compact('enrollments','date'));
	}
	public function saveEnroll(Request $request)
	{
		$enrolls = $this->telecomEnrollmentRepositoryEloquent->getAllEnrollments(['date' => $request->date]);
    	$name = $request->date.'????????????';
		Excel::create($name,function($excel) use ($enrolls){
		  $excel->sheet('score', function($sheet) use ($enrolls){
			$sheet->fromArray($enrolls);
		  });
		})->export('xls');

	}
}
