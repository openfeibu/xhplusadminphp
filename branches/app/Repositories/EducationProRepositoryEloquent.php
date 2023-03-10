<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EducationProRepository;
use App\EducationPro;
use App\Validators\EducationProValidator;

/**
 * Class EducationProRepositoryEloquent
 * @package namespace App\Repositories;
 */
class EducationProRepositoryEloquent extends BaseRepository implements EducationProRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EducationPro::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    public function get($edu_id)
    {
        return EducationPro::where('edu_id',$edu_id)->orderBy('product_id','asc')->get();
    }
    public function deletePro($edu_id)
    {
        return EducationPro::where('edu_id',$edu_id)->delete();
    }
}
