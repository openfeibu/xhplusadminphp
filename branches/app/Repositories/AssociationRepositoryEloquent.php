<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AssociationRepository;
use App\Association;

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
        $associations = Association::orderBy('aid', 'desc')->paginate(config('admin_config.page'));
        return $associations;
    }

    public function getAssociationOne($id){
        $association = Association::where('aid',$id)->first();
        return $association;
    }

    public function createAssociation(){
        
    }

}
