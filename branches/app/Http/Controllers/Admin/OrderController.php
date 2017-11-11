<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use Log;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\HelpService;
use App\Services\MessageService;
use App\Services\AdminRecordService;
use App\Repositories\OrderRepositoryEloquent;
use App\Repositories\TradeAccountRepositoryEloquent;
use App\Repositories\AlipayRefundRepositoryEloquent;
use App\Repositories\WechatRefundRepositoryEloquent;
use App\Repositories\OrderBonusSettingRepositoryEloquent;
use App\Repositories\UserOrderBonusRepositoryEloquent;
use EasyWeChat\Foundation\Application;

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
								WechatRefundRepositoryEloquent $wechatRefundRepositoryEloquent,
								OrderBonusSettingRepositoryEloquent $orderBonusSettingRepositoryEloquent,
								UserOrderBonusRepositoryEloquent $userOrderBonusRepositoryEloquent,
								AdminRecordService $adminRecordService,
								MessageService $messageService)
	{
		parent::__construct();
		$this->helpService = $helpService;
		$this->orderRepositoryEloquent = $orderRepositoryEloquent;
		$this->tradeAccountRepositoryEloquent = $tradeAccountRepositoryEloquent;
		$this->alipayRefundRepositoryEloquent = $alipayRefundRepositoryEloquent;
		$this->wechatRefundRepositoryEloquent = $wechatRefundRepositoryEloquent;
		$this->userOrderBonusRepositoryEloquent = $userOrderBonusRepositoryEloquent;
		$this->orderBonusSettingRepositoryEloquent = $orderBonusSettingRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		$this->messageService = $messageService;
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
		if($order->pay_id == 1)
		{
			$order->batch_num =1;
			$order->detail_data = $order->trade_no.'^'.$order->fee.'^'.'任务退款';
			return view('admin.order.refund', compact('order'));
		}else if($order->pay_id == 2)
		{
			$options = [
				'app_id' => config('wechat.app_id'),
				'payment' => [
					'merchant_id'        => config('wechat.payment.merchant_id'),
					'key'                => config('wechat.payment.key'),
					'cert_path'          => config('wechat.payment.cert_path'),
			        'key_path'           => config('wechat.payment.key_path') ,
				],
			];
			$app_options = [
				'app_id' => config('wechat.app_payment.app_id'),
				'payment' => [
					'merchant_id'        => config('wechat.app_payment.merchant_id'),
					'key'                => config('wechat.app_payment.key'),
					'cert_path'          => config('wechat.app_payment.cert_path'),
			        'key_path'           => config('wechat.app_payment.key_path') ,
				],
			];
			$app = new Application($options);
			$payment = $app->payment;
			$batch_no = $order->order_sn;
			$result = $payment->refund($order->order_sn, $batch_no, $order->fee * 100);
			Log::debug('refund_result_1'.serialize($result));
			//有结果
			if($result)
			{
				//SUCCESS/FAIL  SUCCESS退款申请接收成功，结果通过退款查询接口查询  FAIL 提交业务失败
				if($result['result_code'] == 'SUCCESS')
				{
					$refundData = array(
						'batch_no'	=> $batch_no,
						'refund_status' => 'success',
					);
					$this->wechatRefundRepositoryEloquent->create($refundData);
					Toastr::success('退款成功');
					$this->refundOrder($order->trade_no);
				}else{
					//失败
					if($result['err_code'] == 'ERROR')
					{
						Toastr::error($result['err_code_des']);
					}
					//订单不存在   查看是否app支付
					if($result['err_code'] == 'ORDERNOTEXIST')
					{
						$app = new Application($app_options);
						$payment = $app->payment;
						$result = $payment->refund($order->order_sn, $batch_no, $order->fee * 100);
						Log::debug('refund_result_2'.serialize($result));
						if($result['result_code'] == 'SUCCESS')
						{
							$refundData = array(
								'batch_no'	=> $batch_no,
								'refund_status' => 'success',
							);
							$this->wechatRefundRepositoryEloquent->create($refundData);
							Toastr::success('退款成功');
							$this->refundOrder($order->trade_no);
						}else{
							Toastr::error($result['err_code_des']);
						}
					}
				}
			}
			return redirect(route('admin.order.refundIndex'));
		}

	}
	public function refundOrder($trade_no)
	{
		$trade = $this->tradeAccountRepositoryEloquent->findWhere(['trade_no'=>$trade_no,'trade_status'=>'refunding'],$columns =['uid','id','from','trade_no','out_trade_no','fee'])->first();
		if($trade){
			$this->tradeAccountRepositoryEloquent->update(['trade_status'=>'refunded'],$trade->id);
			if($trade->from == 'order'){
				$update = $this->orderRepositoryEloquent->updateBySn(['status'=>'cancelled'],$trade->out_trade_no);
				if($update){
					$this->messageService->SystemMessage2SingleOne($trade->uid, "任务金额 " . $trade->fee . "元 已原路退回，请留意。");
				}
			}
		}
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
	public function todayRank(Request $request)
	{

		Breadcrumbs::register('admin-order-todayRank',function($breadcrumbs){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('接单排行', route('admin.order.todayRank'));
		});
		$date = isset($request->date) && $request->date ? $request->date : date('Y-m-d');
		$users = $this->orderRepositoryEloquent->getTodayRank($date);

		return view('admin.order.todayRank', compact('users','date'));
	}
	public function getMonthDayRank(Request $request)
	{

		$ranks = $this->orderRepositoryEloquent->getMonthDayRank();
		var_dump($ranks);exit;
	}
	public function orderBonusSetting(Request $request)
    {

		Breadcrumbs::register('admin-order-orderBonusSetting',function($breadcrumbs){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('奖励金列表', route('admin.order.orderBonusSetting'));
		});

		$order_bonus_settings = $this->orderBonusSettingRepositoryEloquent->orderBy('id','asc')->all();

        return view('admin.order.order_bonus_setting', compact('order_bonus_settings'));
    }
	public function orderBonusSettingEdit($id)
	{
		Breadcrumbs::register('admin-order-orderBonusSettingEdit',function($breadcrumbs){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('奖励金列表', route('admin.order.orderBonusSettingEdit'));
		});
		$order_bonus_setting = $this->orderBonusSettingRepositoryEloquent->find($id);
		return view('admin.order.order_bonus_setting_edit', compact('order_bonus_setting'));
	}
	public function orderBonusSettingUpdate(Request $request)
    {
        $result = $this->orderBonusSettingRepositoryEloquent->update($request->all(), $request->id);
        if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.order.orderBonusSetting'));
    }
	public function userOrderBonuses()
	{
		Breadcrumbs::register('admin-order-userOrderBonuses',function($breadcrumbs){
			$breadcrumbs->parent('admin-order');
			$breadcrumbs->push('奖励金获取记录', route('admin.order.userOrderBonuses'));
		});
		$user_order_bonuses = $this->userOrderBonusRepositoryEloquent->getUserOrderBonuses();
		return view('admin.order.user_order_bonuses', compact('user_order_bonuses'));
	}
}
