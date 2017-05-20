<?php

namespace App\Services;

use Log;
use Session;
use Illuminate\Http\Request;
use App\Helper\alidayu\top\TopClient as TopClient;
use App\Helper\alidayu\top\request\AlibabaAliqinFcSmsNumSendRequest as AlibabaAliqinFcSmsNumSendRequest;

class SMSService
{

	protected $request;

	protected $userRepository;

	function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function sendSMS($mobile_no,$type = 'verify',$data = [])
	{
		require app_path() . DIRECTORY_SEPARATOR.'Helper'.DIRECTORY_SEPARATOR.'alidayu'.DIRECTORY_SEPARATOR.'TopSdk.php';
		$c = new TopClient;
		$req = new AlibabaAliqinFcSmsNumSendRequest;
		$req->setSmsType("normal");
		$req->setSmsFreeSignName(config('sms.signName'));
		$req->setRecNum($mobile_no);
		$req->setSmsTemplateCode($data['sms_template_code']);
		switch ($type) {
			case 'verify':
				$code = $data['code'];
				$req->setSmsParam("{\"code\":\"$code\",\"product\":\"校汇\"}");
				break;
			case 'order_info':
				$req->setSmsParam("{\"product\":\"校汇\"}");
				break;
			case 'illegal_task':
				$name = $data['name'];
				$title = $data['title'];
				$req->setSmsParam("{\"product\":\"校汇\",\"name\":\"$name\",\"title\":\"$title\"}");
				break;
			case 'pick_code':
				$code = $data['code'];
				$req->setSmsParam("{\"pick_code\":\"$code\",\"product\":\"校汇\"}");
				break;
			case 'real_name_true':
				$req->setSmsParam("{\"product\":\"校汇\"}");
			default:
				// code...
				break;
		}
		$resp = $c->execute($req);
		if (!isset($resp->result->err_code) or $resp->result->err_code !== '0') {
			throw new \App\Exceptions\Custom\RequestFailedException('短信发送失败');
			Log::error('----------------------------------------------------------------');
			Log::error('短信发送故障，收到阿里大于的错误信息：' . serialize($resp));
			Log::error('----------------------------------------------------------------');
		}
		return true;
	}
}
