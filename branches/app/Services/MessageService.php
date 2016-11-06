<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\MessageRepository;

class MessageService
{

	protected $request;

	protected $messageRepository;

	function __construct(Request $request,
						 MessageRepository $messageRepository
						 )
	{
		$this->request = $request;
		$this->messageRepository = $messageRepository;
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