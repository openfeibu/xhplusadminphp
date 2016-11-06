<?php

namespace App\Repositories;

use DB;
use App\TelecomRealName;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

class TelecomRealNameRepositoryEloquent extends BaseRepository implements TelecomRealNameRepository
{
	
	public function model()
    {
        return TelecomRealName::class;
    }
	
}