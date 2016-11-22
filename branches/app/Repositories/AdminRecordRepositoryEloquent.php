<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdminRecordRepository;
use App\AdminRecord;
use DB;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdminRecordRepositoryEloquent extends BaseRepository implements AdminRecordRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdminRecord::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getHistoryList(){
        return AdminRecord::select(DB::raw('admin_record.*,admin_users.name,admin_users.email'))
                            ->leftJoin('admin_users','admin_record.handler_id','=','admin_users.id')
                            ->orderBy('admin_record.id','desc')
                            ->paginate(config('admin_config.page'));
    }
}
