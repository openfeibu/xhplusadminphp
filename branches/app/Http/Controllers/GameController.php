<?php

namespace App\Http\Controllers;

use Redis;
use Log;

use App\Game as Game;
use App\Http\Requests;
use Illuminate\Http\Request;

class GameController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	public function game(){
		return view('game');
	}
}