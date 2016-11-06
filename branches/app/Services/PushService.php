<?php

namespace App\Services;

use Log;
use App\Helpers\Xinge\XingeApp;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\Facades\Session; 

class PushService
{
	// protected $xinge;

	protected $userRepositoryEloquent;

	function __construct(XingeApp $xinge,
						 UserRepositoryEloquent $userRepositoryEloquent)
	{
		$this->xinge = $xinge;
		$this->userRepositoryEloquent = $userRepositoryEloquent;
	}

	/**
	 * 记录推送失败信息
	 */
	public function logFailedPush($info)
	{
		if (!$info or $info['ret_code'] !== 0) {
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
	public function PushTokenAndroid($title, $content, $token)
	{
		return $this->xinge->PushTokenAndroid($title, $content, $token);
	}

	/**
	 * 使用默认设置推送消息给单个ios设备
	 */
	public static function PushTokenIos($content, $token, $environment = '')
	{
		$environment = $environment ?: $this->xinge->IOSENV_PROD;
		return $this->xinge->PushTokenIos($content, $token, $environment);
	}

	/**
	 * 使用默认设置推送消息给指定用户的android/ios设备
	 */
	public function PushUserTokenDevice($title, $content, $user_id)
	{
		$device = $this->userRepositoryEloquent->getDeviceTokenByUserID($user_id);

		if ($device->platform == 'and') {
			$ret = $this->PushTokenAndroid($title, $content, $device->device_token);
		} elseif ($device->platform == 'ios') {
			$ret = $this->PushTokenIos($content, $device->device_token);
		} else {
			$ret = '';
		}

		//记录推送失败信息
		$this->logFailedPush($ret);

		return $ret;
	}

	/**
	 * 使用默认设置推送消息给当前用户的android/ios设备
	 */
	public function PushCurrentUserTokenDevice($title, $content)
	{
		$user_id = Session::get('uid');

		return $this->PushUserTokenDevice($title, $content, $user_id);
	}




	/**
	 * 使用默认设置推送消息给指定用户账号
	 */
	public function PushUserAccount($title, $content, $user_id)
	{
		$user = $this->userRepositoryEloquent->getUserOne($user_id);

		$ret = $this->PushAccountAndroid($title, $content, $user->openid);

		//记录推送失败信息
		$this->logFailedPush($ret);

		return $ret;
	}

	/**
	 * 使用默认设置推送消息给用户账号
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
		$user_id = Session::get('uid');

		return $this->PushUserTokenAccount($title, $content, $user_id);
	}

}