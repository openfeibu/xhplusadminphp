<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Breadcrumbs, Toastr;
use Excel;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\HelpService;
use App\Services\MessageService;
use App\Repositories\TradeAccountRepositoryEloquent;
use App\Repositories\AlipayRefundRepositoryEloquent;
use App\Repositories\WechatRefundRepositoryEloquent;
use EasyWeChat\Foundation\Application;

class OrderInfoController extends BaseController
{
	public function __construct(TradeAccountRepositoryEloquent $tradeAccountRepositoryEloquent,
								AlipayRefundRepositoryEloquent $alipayRefundRepositoryEloquent,
								WechatRefundRepositoryEloquent $wechatRefundRepositoryEloquent,
								HelpService $helpService,
								MessageService $messageService){

		parent::__construct();
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-orderInfo',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('店铺管理', route('admin.shop.index'));
		});
		$this->helpService = $helpService;
		$this->messageService = $messageService;
		$this->tradeAccountRepositoryEloquent = $tradeAccountRepositoryEloquent;
		$this->alipayRefundRepositoryEloquent = $alipayRefundRepositoryEloquent;
		$this->wechatRefundRepositoryEloquent = $wechatRefundRepositoryEloquent;
	}

    public function index ()
    {
    	Breadcrumbs::register('admin-orderInfo-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});

		$order_infos = app('orderInfoRepositoryEloquent')->getOrderInfos();
        return view('admin.order_info.index', compact('order_infos'));
    }
	public function shopCouponCount(Request $request)
	{
		Breadcrumbs::register('admin-orderInfo-couponCount',function($breadcrumbs){
			$breadcrumbs->parent('admin-orderInfo');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});
		$shop_coupon_count = app('orderInfoRepositoryEloquent')->getShopCouponCount();

		return view('admin.order_info.shop_coupon_count', compact('shop_coupon_count'));
	}
	public function getMonthDayRank(Request $request)
	{
		Breadcrumbs::register('admin-orderInfo-getMonthDayRank',function($breadcrumbs){
			$breadcrumbs->parent('admin-orderInfo');
			$breadcrumbs->push('店铺列表', route('admin.shop.index'));
		});
		$dateym = isset($request->dateym) && $request->dateym ? $request->dateym : date('Y-m');
		$ranks = app('orderInfoRepositoryEloquent')->getMonthDayRank($dateym);
		$count_sum = $seller_shipping_fee_sum = $shipping_fee_sum = $goods_amount_sum = 0;
		foreach ($ranks as $key => $rank) {
			$count_sum += $rank->count;
			$seller_shipping_fee_sum += $rank->seller_shipping_fee;
			$shipping_fee_sum += $rank->shipping_fee;
			$goods_amount_sum += $rank->goods_amount;
		}
		return view('admin.order_info.canteen_month_day_rank', compact('ranks','dateym','count_sum','seller_shipping_fee_sum','shipping_fee_sum','goods_amount_sum'));
	}
	public function monthDayRankDownload(Request $request)
	{
		$dateym = isset($request->dateym) && $request->dateym ? $request->dateym : date('Y-m');
		$ranks = app('orderInfoRepositoryEloquent')->monthDayRankDownload($dateym);
		$count_sum = $seller_shipping_fee_sum = $shipping_fee_sum = $goods_amount_sum = 0;
		foreach ($ranks as $key => $rank) {
			$count_sum += $rank->订单量;
			$goods_amount_sum += $rank->订单总商品额;
			$seller_shipping_fee_sum += $rank->商家出总运费;
			$shipping_fee_sum += $rank->买家出总运费;
		}
		$ranks = $ranks ? $ranks->toArray() : [];
		$ranks = array_merge($ranks,[['日期' => '','订单量' => $count_sum,'订单总商品额' => $goods_amount_sum.'元','商家出总运费' => $seller_shipping_fee_sum.'元','买家出总运费' => $shipping_fee_sum.'元']]);
		$name = $request->dateym.'饭堂每天销量列表';
		Excel::create($name,function($excel) use ($ranks){
		  	$excel->sheet('score', function($sheet) use ($ranks){
				$sheet->fromArray($ranks);
		  	});
		})->export('xls');
	}
	public function refundIndex()
	{
		Breadcrumbs::register('admin-orderInfo-refundIndex',function($breadcrumbs){
			$breadcrumbs->parent('admin-orderInfo');
			$breadcrumbs->push('退款任务', route('admin.order_info.refundIndex'));
		});
		$order_infos = app('orderInfoRepositoryEloquent')->getRefundOrderInfos();

		return view('admin.order_info.refundIndex', compact('order_infos'));
	}
	public function refund($id)
	{
		$order_info = app('orderInfoRepositoryEloquent')->getRefundOrderInfo($id);
		if($order_info->pay_id == 1)
		{
			Breadcrumbs::register('admin-orderInfo-refund',function($breadcrumbs) use ($id){
				$breadcrumbs->parent('admin-orderInfo');
				$breadcrumbs->push('退款编辑', route('admin.order_info.refund', ['id' => $id]));
			});
			$order_info->batch_num =1;
			$order_info->detail_data = $order_info->trade_no.'^'.$order_info->fee.'^'.'任务退款';
			return view('admin.order_info.refund', compact('order_info'));
		}else if($order_info->pay_id == 2)
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
			$batch_no = $this->helpService->buildBatchNo();
			$result = $payment->refund($order_info->order_sn, $batch_no, $order_info->fee * 100);

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
					$this->refundOrderInfo($order_info->trade_no);
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
						$result = $payment->refund($order_info->order_sn, $batch_no, $order_info->fee * 100);
						if($result['result_code'] == 'SUCCESS')
						{
							$refundData = array(
								'batch_no'	=> $batch_no,
								'refund_status' => 'success',
							);
							$this->wechatRefundRepositoryEloquent->create($refundData);
							Toastr::success('退款成功');
							$this->refundOrderInfo($order_info->trade_no);
						}else{
							Toastr::error($result['err_code_des']);
						}
					}
				}
			}
			return redirect(route('admin.order_info.refundIndex'));
		}

	}
	private function refundOrderInfo($trade_no)
	{
		$trade = $this->tradeAccountRepositoryEloquent->findWhere(['trade_no'=>$trade_no,'trade_status'=>'refunding'],$columns =['uid','id','from','trade_no','out_trade_no','fee'])->first();
		if($trade){
			$this->tradeAccountRepositoryEloquent->update(['trade_status'=>'refunded'],$trade->id);
			if($trade->from == 'shop'){
				$update = app('orderInfoRepositoryEloquent')->updateBySn(['order_status'=>'4'],$trade->out_trade_no);
				if($update){
					$this->messageService->SystemMessage2SingleOne($trade->uid, "任务金额 " . $trade->fee . "元 已原路退回，请留意。");
				}
			}
		}
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
}
