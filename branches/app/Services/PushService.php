<?php

namespace App\Services;

use Log;
use App\Helper\Xinge\XingeApp;
use App\Repositories\UserRepositoryEloquent;

use App\Helper\xmpush\Constants;
use App\Helper\xmpush\Sender;
use App\Helper\xmpush\HttpBase;
use App\Helper\xmpush\Builder;
use App\Helper\xmpush\Message;
use App\Helper\xmpush\Result;
use App\Helper\xmpush\ErrorCode;
use App\Helper\xmpush\TargetedMessage;

class PushService
{
	protected $xinge;

	protected $userRepository;

	function __construct(XingeApp $xinge,
						 UserRepositoryEloquent $userRepository)
	{
		$this->xinge = $xinge;
		$this->userRepository = $userRepository;
	}


	/**
	 * 使用默认设置推送消息给指定用户id的android/ios设备
	 */
	public function PushUserTokenDevice($title, $content, $user_id,$type = 1)
	{
		$device = $this->userRepository->getDeviceTokenByUserID($user_id);
		if(!$device){
			return false;
		}
		Log::debug($device->push_server);
		$user = $this->userRepository->getUserByUserID($user_id);
		switch ($device->platform) {
			case 'and':
				switch ($device->push_server) {
					case 'xinge':
						$ret = $this->PushTokenAndroid($title, $content, $user_id,$type);
						//记录推送失败信息
						$this->logFailedPush($ret);
						break;

					case 'xiaomi':
				        $payload = '{"test":1,"ok":"It\'s a string"}';
				        $desc = '你有新消息';
				        Constants::setPackage(config('xiaomi.package'));
						Constants::setSecret(config('xiaomi.secret'));
						$sender = new Sender();
						$message1 = new Builder();
				       if($type == 1)
				        {
					        $message1->title($title);  // 通知栏的title
				        	$message1->description($content); // 通知栏的descption
				        	$message1->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
				        	$message1->extra(Builder::notifyForeground, 0); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
				        }else{
					        $message1->passThrough(1);
					        $message1->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
				        }
						$message1->payload($content); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。

						$message1->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
						$message1->build();
						$targetMessage = new TargetedMessage();
						$targetMessage->setTarget('userAccount', TargetedMessage::TARGET_TYPE_USER_ACCOUNT); // 设置发送目标。可通过regID,alias和topic三种方式发送
						$targetMessage->setMessage($message1);

						//$ret = $sender->sendToAliases($message1,$aliasList)->getRaw();
						$ret = $sender->sendToUserAccount($message1,$user->openid);
						//var_dump($ret);
						break;

					default:
						$ret = '非法推送提供商';
						break;
				}
				break;

			case 'ios':
				$ret = $this->PushTokenIos($content, $device->device_token);
				break;

			default:
				$ret = '非法platform类型';
				break;
		}

		//记录推送失败信息
		// $this->logFailedPush($ret);

		return $ret;
	}


	/**
	 * 使用默认设置推送消息给当前用户的android/ios设备
	 */
	public function PushCurrentUserTokenDevice($title, $content)
	{
		$user_id = $this->userRepository->getUser()->uid;

		return $this->PushUserTokenDevice($title, $content, $user_id);
	}




	/**
	 * 记录推送失败信息
	 */
	public function logFailedPush($info)
	{
		if (!$info or $info['ret_code'] != 0) {
			Log::info('-------------------------');
			Log::info('failure to push: ' . serialize($info));
			Log::info('-------------------------');
			return true;
		}
		return false;
	}

	/**
	 * 使用默认设置推送消息给单个android设备
	 */
	public function PushTokenAndroid($title, $content, $user_id,$type = 1)
	{
		if($type == 1){
			//传送
			return $this->PushUserAccount($title, $content, $user_id);
		}else{
			//透传
			return $this->PushUserAccountMessage($title, $content, $user_id);
		}

	}

	/**
	 * 使用默认设置推送消息给指定用户账号
	 */
	public function PushUserAccount($title, $content, $user_id)
	{
		$user = $this->userRepository->getUserByUserID($user_id);

		$ret = $this->PushAccountAndroid($title, $content, $user->openid);

		//记录推送失败信息
		$this->logFailedPush($ret);

		return $ret;
	}
	/**
	 * 使用默认设置透传消息给指定用户账号
	 */
	public function PushUserAccountMessage($title, $content, $user_id)
	{

		$user = $this->userRepository->getUserByUserID($user_id);

		$device = $this->userRepository->getDeviceTokenByUserID($user_id);

		$ret = $this->xinge->PushAccountMessage($title, $content, $user->openid);
		//$ret = $this->xinge->PushSingleDeviceMessage( $title, $content, $device->device_token);

		$this->logFailedPush($ret);

		return $ret;
	}
	/**
	 * 使用默认设置推送消息给安卓用户账号
	 */
	public function PushAccountAndroid($title, $content, $openid)
	{
		return $this->xinge->PushAccountAndroid($title, $content, $openid);
	}

	/**
	 * 使用默认设置推送消息给当前用户账号
	 */
	public function PushCurrentUserAccount($title, $content)
	{
		$user_id = $this->userRepository->getUser()->uid;

		return $this->PushUserAccount($title, $content, $user_id);
	}

}
