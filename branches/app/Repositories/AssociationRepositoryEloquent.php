<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssociationRepository;
use App\Association;
use App\Association_label;
use DB;

/**
 * Class AdminUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AssociationRepositoryEloquent extends BaseRepository implements AssociationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Association::class;
    }

    public function getAssociationAll(){
        $associations = Association::orderBy('sort', 'desc')->paginate(config('admin_config.page'));
        return $associations;
    }

    public function getAssociationOne($id){
        $association = Association::where('aid',$id)->first();
        return $association;
    }

    public function createAssociation(){
        
    }

    public function getAccusationLabel(){
        return Association_label::get();
    }

    public function getMaxSort(){
        return Association::select(DB::raw('max(sort) as max_sort'))
                            ->first();
    }
    public function updateAssociationSort($max_sort,$aid){
        $update = Association::where('aid',$aid)->update([
                'sort' => $max_sort+1,
            ]);
        if($update){
            return 200;
        }else{
            return 403;
        }
    }

}
