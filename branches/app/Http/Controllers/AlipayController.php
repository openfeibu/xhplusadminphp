<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Log;
use App\Http\Requests;
use App\AlipayRefund;
use App\TradeAccount;
use App\Repositories\AlipayRefundRepositoryEloquent;
use App\Repositories\TradeAccountRepositoryEloquent;
use App\Repositories\OrderRepositoryEloquent;
use App\Services\MessageService;

class AlipayController extends Controller
{
	protected $alipayRefundRepositoryEloquent;

	protected $tradeAccountRepositoryEloquent;

    public function __construct(OrderRepositoryEloquent $orderRepositoryEloquent,
								AlipayRefundRepositoryEloquent $alipayRefundRepositoryEloquent,
								TradeAccountRepositoryEloquent $tradeAccountRepositoryEloquent,
								MessageService $messageService)
	{
		$this->alipayRefundRepositoryEloquent = $alipayRefundRepositoryEloquent;
		$this->tradeAccountRepositoryEloquent = $tradeAccountRepositoryEloquent;
		$this->orderRepositoryEloquent = $orderRepositoryEloquent;
		$this->messageService = $messageService;
	}
	public function alipayRefundNotify()
	{
		Log::debug("支付宝退款回调开始");
		$alipayRefund = app('alipay.refund');
		$alipay_config = array_merge(config('alipay-refund'),config('alipay'));
		$verify_result = $alipayRefund->verifyNotify();

		if($verify_result) {//验证成功

			$batch_no = Input::get('batch_no');
			$success_num = Input::get('success_num');
			$result_details = Input::get('result_details');
			Log::debug("batch_no".$batch_no);
			Log::debug("success_num".$success_num);
			Log::debug("result_details".$result_details);
			$alipayRefundData = array(
				'batch_no'	=> $batch_no,
				'success_num' => $success_num,
				'result_details' => $result_details,
				'refund_status' => 'success',
			);
			$updateAlipayRefundStatus = AlipayRefund::where('batch_no', $batch_no)
										->where('refund_status','wait')
										->update($alipayRefundData);
			if($updateAlipayRefundStatus){
				$details = explode('#',$result_details);
				$detailsArr = array_filter($details);
				foreach($detailsArr as $key => $detail)
				{
					$trade_no_arr = explode('^',$detail);
					$trade_no_arr = array_filter($trade_no_arr);
					$trade_no = $trade_no_arr[0];
					$status = $trade_no_arr[2];
					if($status == 'SUCCESS')
					{
						$this->refundOrder($trade_no);
					}
				}
			}

			echo "success";

			Log::debug("支付宝退款回调 success");
		}
		else {
			//验证失败
			echo "fail";
			Log::debug("支付宝退款回调 fail");
			//调试用，写文本函数记录程序运行情况是否正常
			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
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
					$this->messageService->SystemMessage2SingleOne($trade->uid, "任务金额 " . $trade->fee . "元 已原路退回，请注意查收");
				}

			}
		}
	}
}
