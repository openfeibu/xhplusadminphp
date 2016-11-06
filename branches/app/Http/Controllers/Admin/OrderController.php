<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\HelpService;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\TradeAccountRepositoryEloquent;
use App\Repositories\AlipayRefundRepositoryEloquent;
use App\Services\AdminRecordService;
 
class OrderController extends BaseController
{
	protected $helpService;
	
    protected $OrderRepositoryEloquent;
	
	protected $tradeAccountRepositoryEloquent;
	
	protected $adminRecordService;

	protected $alipayRefundRepositoryEloquent;
	
	public function __construct(OrderRepositoryEloquent $orderRepositoryEloquent,
								TradeAccountRepositoryEloquent $tradeAccountRepositoryEloquent,
								HelpService $helpService,
								AlipayRefundRepositoryEloquent $alipayRefundRepositoryEloquent,
								AdminRecordService $adminRecordService)
	{
		parent::__construct();
		$this->helpService = $helpService;
		$this->orderRepositoryEloquent = $orderRepositoryEloquent;
		$this->tradeAccountRepositoryEloquent = $tradeAccountRepositoryEloquent;
		$this->alipayRefundRepositoryEloquent = $alipayRefundRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-order',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('任务管理', route('admin.order.index'));
		});
	}
	public function index()
	{
		Breadcrumbs::register('admin-order-index',function($breadcrumbs){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('任务列表', route('admin.order.index'));
		});
		$orders = $this->orderRepositoryEloquent->getOrderList();
        return view('admin.order.index', compact('orders'));
	}
	public function create()
	{
		
	}	
	public function store(Request $request)
	{
		
	}
	public function edit($id)
	{
		Breadcrumbs::register('admin-order-edit',function($breadcrumbs) use ($id){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('编辑任务', route('admin.order.edit', ['id' => $id]));
		});
		$order = $this->orderRepositoryEloquent->find($id,$columns = ['oid','status','description']);
        return view('admin.order.edit', compact('order'));
	}
	public function update($id)
	{
		$result = $this->orderRepositoryEloquent->update( Input::all(), $id );
		$order = $this->orderRepositoryEloquent->find($id,$columns = ['out_trade_no','status','order_sn']);

        if(!$result) {
            Toastr::error("任务更新失败");
        } else {

			$trade = $this->tradeAccountRepositoryEloquent->findByField('out_trade_no',$order->order_sn,$columns = ['id','out_trade_no','trade_status']);
			

			if(Input::get('status') == 'success'&&$trade->trade_status == 'cashing')
			{
		   		$record = "任务管理，更改任务状态,订单id为：".$id;
		   		$this->adminRecordService->record($record);
				$this->tradeAccountRepositoryEloquent->update(['trade_status'=>'cashed'],$trade->id);
			}
		
            Toastr::success('任务更新成功');
        }
        return redirect(route('admin.order.edit', ['id' => $id]));
	}
	public function destroy($id)
	{
		$order = $this->orderRepositoryEloquent->find($id);
		$record = "删除任务订单，订单内容为：".$order->description;
        $this->adminRecordService->record($record);
		$result = $this->orderRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	public function destroyall(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
        	$order = $this->orderRepositoryEloquent->find($id);
			$record = "删除任务订单，订单内容为：".$order->description;
	        $this->adminRecordService->record($record);
            $result = $this->orderRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	public function refundIndex()
	{
		Breadcrumbs::register('admin-order-refundIndex',function($breadcrumbs){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('退款任务', route('admin.order.refundIndex'));
		});
		$orders = $this->orderRepositoryEloquent->getRefundOrders();

		return view('admin.order.refundIndex', compact('orders'));
	}
	public function refund($id)
	{
		Breadcrumbs::register('admin-order-refund',function($breadcrumbs) use ($id){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('退款编辑', route('admin.order.refund', ['id' => $id]));
		});
		$order = $this->orderRepositoryEloquent->getRefundOrder($id);
		$order->batch_num =1;
		$order->detail_data = $order->trade_no.'^'.$order->fee.'^'.'任务退款';
        return view('admin.order.refund', compact('order'));
	}
	public function refundAll($ids)
	{
		Breadcrumbs::register('admin-order-refund',function($breadcrumbs) use ($ids){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('退款编辑', route('admin.order.refund', ['id' => $ids]));
		});
		$ids = array_filter(explode(',',$ids));
		$orders = $this->orderRepositoryEloquent->getRefundOrdersByIds($ids);
		$order = (object)array();
		$order->detail_data = '';
		$order->batch_num = count($orders);
		foreach($orders as $key => $val)
		{
			$order->detail_data .= $val->trade_no.'^'.$val->fee.'^'.'任务退款#';
		}
		$order->detail_data = rtrim($order->detail_data,'#');
		return view('admin.order.refund', compact('order'));
	}
	public function refundHandle()
	{
		$alipayRefund = app('alipay.refund');
		$alipay_config = array_merge(config('alipay-refund'),config('alipay'));
		$batch_no = $this->helpService->buildBatchNo();
		$batch_num = Input::get('WIDbatch_num');
        $detail_data = Input::get('WIDdetail_data');
		
		$parameter = array(
			'service' => trim($alipay_config['service']),
			'partner' => trim($alipay_config['partner']),
			'notify_url'	=> config('app.url').'/alipay/alipayRefundNotify',
			'seller_user_id'	=> trim($alipay_config['partner']),
			'refund_date'	=> trim($alipay_config['refund_date']),
			'batch_no'	=> $batch_no,
			'batch_num'	=> $batch_num,
			'detail_data'	=> $detail_data,
			'_input_charset'	=> trim(strtolower($alipay_config['input_charset']))
		);
		$alipayRefundData = array(
			'batch_no'	=> $batch_no,
			'batch_num'	=> $batch_num,
			'detail_data'	=> $detail_data,
			'success_num' => '',
			'result_details' => '',
			'refund_status' => 'wait',
		);
		$this->alipayRefundRepositoryEloquent->create($alipayRefundData);
		//建立请求
		$html_text = $alipayRefund->buildRequestForm($parameter,"get", "确认");

		echo $html_text;

	}
	public function destroyRefund($id)
	{
		$order = $this->orderRepositoryEloquent->find($id);
		$record = "删除退款，订单内容为：".$order->description;
        $this->adminRecordService->record($record);
		$result = $this->orderRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	public function destroyRefundAll(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
            $result = $this->orderRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
}
