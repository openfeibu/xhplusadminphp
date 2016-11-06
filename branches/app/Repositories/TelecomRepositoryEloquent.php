<?php

namespace App\Repositories;

use DB;
use App\TelecomPackage;
use App\TelecomRealName;
use App\TelecomOrder;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

class TelecomRepositoryEloquent extends BaseRepository implements TelecomRepository
{
	
	public function model()
    {
        return TelecomPackage::class;
    }
	
}