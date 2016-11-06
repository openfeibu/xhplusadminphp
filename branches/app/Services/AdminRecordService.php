<?php

namespace App\Services;

use App\Repositories\AdminRecordRepositoryEloquent;
use Illuminate\Http\Request;
use Route,URL,Auth;
use App\AdminRecord;


class AdminRecordService
{

	protected $adminRecord;

	function __construct(AdminRecordRepositoryEloquent $adminRecord)
	{
		$this->adminRecord = $adminRecord;
	}

	public function record($record){
		$user_id = Auth::guard('admin')->user()->id;
		$adminRecord = new AdminRecord;
		$adminRecord->handler_id = $user_id;
		$adminRecord->record = $record;
		$adminRecord->save();
	}

}