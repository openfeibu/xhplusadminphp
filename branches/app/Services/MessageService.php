<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\MessageRepository;

class MessageService
{

	protected $request;

	protected $messageRepository;
	protected $pushService;

	function __construct(PushService $pushService,
						 MessageRepository $messageRepository
						 )
	{
		$this->messageRepository = $messageRepository;
		$this->pushService = $pushService;
	}

	/**
	 * 获取纸条列表
	 */
	public function getMessageList(array $param)
	{
		$param['uid'] = $this->userRepository->getUser()->uid;
		return $this->messageRepository->getMessageList($param);
	}


	/**
	 * 为指定的用户创建纸条
	 */
	public function SystemMessage2SingleOne($user_id, $content, $push = false, $type = '系统通知', $name = '系统')
	{
		$this->messageRepository->createMessageSingleOne($user_id, '1', $type, $name, $content);
		//将纸条推送到设备
		$data = [
			'refresh' => 1,
			'target' => 'message',
			'data' => $content
		];
		$this->pushService->PushUserTokenDevice($type, json_encode($data), $user_id,2);
		return true;
	}

	/**
	 * 为当前用户创建纸条
	 */
	public function SystemMessage2CurrentUser($content, $push = false, $type = '系统通知', $name = '系统')
	{
		//获取当前用户信息
		$uid = $this->userRepository->getUser()->uid;

		//创建纸条
		$this->SystemMessage2SingleOne($uid, $content, $push = false, $type, $name);
		return true;
	}

	/**
	 * 发送纸条给任务中另一方
	 */
	public function SystemMessage2OtherOfOrder()
	{
		# code...
	}

}
