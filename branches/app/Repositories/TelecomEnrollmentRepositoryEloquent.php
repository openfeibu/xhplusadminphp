<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TelecomEnrollmentRepository;
use DB;
use App\TelecomEnrollment;
use App\Validators\TelecomEnrollmentValidator;

/**
 * Class TelecomEnrollmentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TelecomEnrollmentRepositoryEloquent extends BaseRepository implements TelecomEnrollmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TelecomEnrollment::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function getEnrollments($where = [])
    {
        return TelecomEnrollment::orderBy('date','desc')
                                ->orderBy('time_start','asc')
                                ->where($where)
                                ->select('*')
                                ->paginate(config('admin_config.page'));
    }
    public function getAllEnrollments($where = [])
    {
        return TelecomEnrollment::select(DB::raw('name as "姓名",time_start as "预约开始时间" ,time_end as "预约结束时间", date as "日期"'))
                                ->orderBy('date','desc')
                                ->orderBy('time_start','asc')
                                ->where($where)
                                ->get(['*']);
    }
}
