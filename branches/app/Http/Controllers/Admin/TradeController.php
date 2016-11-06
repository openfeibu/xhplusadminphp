<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Breadcrumbs, Toastr;
use App\Repositories\TradeAccountRepositoryEloquent;
use App\Services\AdminRecordService;

class TradeController extends BaseController
{
    protected $tradeAccountRepositoryEloquent;

    protected $adminRecordService;
	
	public function __construct(TradeAccountRepositoryEloquent $tradeAccountRepositoryEloquent,
								AdminRecordService $adminRecordService)
	{
		parent::__construct();
		$this->tradeAccountRepositoryEloquent = $tradeAccountRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-trade',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('交易管理', route('admin.trade.index'));
		});
		
	}	
	public function index()
	{
		Breadcrumbs::register('admin-trade-index',function($breadcrumbs){
			$breadcrumbs->parent('admin-trade');
			$breadcrumbs->push('交易记录', route('admin.trade.index'));
		});
		$trades = $this->tradeAccountRepositoryEloquent->scopeQuery(function($query){
			return $query->orderBy('id','desc');
		})->paginate(config('admin_config.page'));

        return view('admin.trade.index', compact('trades'));
	}
	public function create()
	{
		
	}
	public function store(Request $request)
	{
		
	}
	public function edit($id)
	{
		Breadcrumbs::register('admin-trade-edit',function($breadcrumbs) use ($id){
			$breadcrumbs->parent('admin-trade');
			$breadcrumbs->push('编辑套餐', route('admin.trade.edit', ['id' => $id]));
		});
		$trade = $this->tradeAccountRepositoryEloquent->find($id,$columns = ['id','trade_status','description']);

        return view('admin.trade.edit', compact('trade'));
	}
	public function update($id)
	{
		$result = $this->tradeAccountRepositoryEloquent->update( Input::all(), $id );
        if(!$result) {
            Toastr::error("套餐更新失败");
        } else {
        	$record = "交易管理，套餐更新，套餐id为：".$id;
	        $this->adminRecordService->record($record);
            Toastr::success('套餐更新成功');
        }
        return redirect(route('admin.trade.edit', ['id' => $id]));
	}
	public function destroy($id)
	{
		$tradeAccount = $this->tradeAccountRepositoryEloquent->find($id);
        $record = "交易管理，交易删除,交易用户id为：".$tradeAccount->uid;
        $this->adminRecordService->record($record);
		$result = $this->tradeAccountRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	public function destroyall(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
        	$tradeAccount = $this->tradeAccountRepositoryEloquent->find($id);
	        $record = "交易管理，交易删除,交易用户id为：".$tradeAccount->uid;
	        $this->adminRecordService->record($record);
            $result = $this->tradeAccountRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
}
