<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Breadcrumbs, Toastr;
use App\Repositories\AdminRecordRepositoryEloquent;

class OperateHistoryController extends BaseController
{

	protected $adminRecordRepositoryEloquent;
		
    public function __construct(AdminRecordRepositoryEloquent $adminRecordRepositoryEloquent)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-operateHistory', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('操作历史', route('admin.operateHistory.index'));
        });

        $this->adminRecordRepositoryEloquent = $adminRecordRepositoryEloquent;

    }
    
	public function index()
    {
    	Breadcrumbs::register('admin-operateHistory-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('操作历史列表', route('admin.operateHistory.index'));
		});
		$historyLists = $this->adminRecordRepositoryEloquent->getHistoryList();
        return view('admin.operateHistory.index',compact('historyLists'));
    }

    public function destroy(Request $request){
		$result = $this->adminRecordRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function destroy_all(Request $request){
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
            $result = $this->adminRecordRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}

}
