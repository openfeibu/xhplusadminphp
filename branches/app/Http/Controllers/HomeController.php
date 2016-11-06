<?php

namespace App\Http\Controllers;

use Redis;
use Log;

use App\User as User;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new User();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
	    //$redis = Redis::connection('default');
	    
     //   $cacheUsers = $redis->get('userList');

     //   if( $cacheUsers ){
     //       $users = $cacheUsers;
     //       print_r($users);
     //       Log::info('获取用户列表，通过redis');
     //   }else{
     //       $users = $this->model->get();
     //       $redis->set('userList', $users);
     //       print_r($users);
     //       Log::info('获取用户列表，通过msyql');
     //   }
        return view('home');
    }
}
