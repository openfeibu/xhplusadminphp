<?php

namespace App\Http\Controllers;

use Redis;
use Log;
use DB;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
		$user = DB::table('user')->where('uid',21)->first();
		$users = new User;
	    echo "<pre>";
		print_r($user);
    }
}
