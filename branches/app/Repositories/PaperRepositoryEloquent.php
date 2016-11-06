<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PaperRepository;
use App\Paper;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PaperRepositoryEloquent extends BaseRepository implements PaperRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Paper::class;
    }

    public function getPaperOne($id){
        $paper = Paper::where('id',$id)->first();;
        return $paper;
    }

}
