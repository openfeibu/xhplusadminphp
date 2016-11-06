<?php

namespace App\Repositories;

use DB;
use Log;
use Session;
use App\User;
use App\UserInfo;
use App\Real_name_auth;
use Illuminate\Http\Request;

class RealnameRepository
{	
	public function real_list_all()
	{
		$realname = Real_name_auth::leftJoin('user', 'user.uid', '=', 'real_name_auth.uid')
									->leftJoin('user_info','user_info.uid','=','real_name_auth.uid')
									->select('real_name_auth.*','user_info.realname','user.*','user.created_at as user_created_at','real_name_auth.created_at')
									->orderBy('id', 'desc')
									->paginate(config('admin_config.page'));
		return $realname;
	}
	public function real_list_pass()
	{
		$realname = Real_name_auth::leftJoin('user', 'user.uid', '=', 'real_name_auth.uid')
									->leftJoin('user_info','user_info.uid','=','real_name_auth.uid')
									->where('user_info.realname',"!=","")
									->select('real_name_auth.*','user_info.realname','user.*','user.created_at as user_created_at','real_name_auth.created_at')
									->orderBy('id', 'desc')
									->paginate(config('admin_config.page'));
		return $realname;
	}
	public function real_list_fail()
	{
		$realname = Real_name_auth::leftJoin('user', 'user.uid', '=', 'real_name_auth.uid')
									->leftJoin('user_info','user_info.uid','=','real_name_auth.uid')
									->where('user_info.realname',"=","")
									->select('real_name_auth.*','user_info.realname','user.*','user.created_at as user_created_at','real_name_auth.created_at')
									->orderBy('id', 'desc')
									->paginate(config('admin_config.page'));
		return $realname;
	}
	public function real_edit($request,$id){
		$realname = DB::table('real_name_auth')
					->where('real_name_auth.id',$id)
					->leftJoin('user', 'user.uid', '=', 'real_name_auth.uid')
					->leftJoin('user_info','user_info.uid','=','real_name_auth.uid')
					->first();
		$form_data = array(
			"uid" => $realname->uid,
			"username" => $realname->realname,
			"pros_img" => $realname->pic1,
			"cons_img" => $realname->pic2,
		);
		$request->session()->put('form_data',$form_data);
		return $realname;
	}
	public function real_form_data($request){
		$form_data = array(
			"uid" => $request->uid,
			"username" => $request->username,
			"pros_img" => $request->pic1, 
			"cons_img" => $request->pic2,
		);
		$request->session()->put('form_data',$form_data);
	}
}