<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\MessageService;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    protected $messageService;

    function __construct(MessageService $messageService)
    {
	    parent::__construct();
        $this->middleware('auth');

        $this->messageService = $messageService;
    }
    public function getMessageList(Request $request)
    {

        $param = [
            'page' => $request->page,
            'num' => $request->num,
        ];
        //获取纸条列表
        $message = $this->messageService->getMessageList($param);

        return [
            'code' => 200,
            'detail' => '请求成功',
            'data' => $message,
        ];
    }
}
