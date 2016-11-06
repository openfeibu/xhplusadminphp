<?php

namespace App\Repositories;

use DB;
use App\TelecomPackage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

class TelecomPackageRepositoryEloquent extends BaseRepository implements TelecomPackageRepository
{
	
	public function model()
    {
        return TelecomPackage::class;
    }
	
}