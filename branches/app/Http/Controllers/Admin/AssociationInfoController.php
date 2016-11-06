<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Breadcrumbs, Toastr;
use DB;
use App\Information;
use App\Repositories\AssociationInfoRepositoryEloquent;
use App\Repositories\AssociationRepositoryEloquent;
use App\Services\AdminRecordService;

class AssociationInfoController extends BaseController
{
	protected $associationInfoRepositoryEloquent;
	protected $associationRepositoryEloquent;
	protected $adminRecordService;
	
    public function __construct(AssociationInfoRepositoryEloquent $associationInfoRepositoryEloquent,
    							AssociationRepositoryEloquent $associationRepositoryEloquent,
    							AdminRecordService $adminRecordService)
    {
        parent::__construct();

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-association_info', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('社团资讯管理', route('admin.association_info.index'));
        });
		
		$this->associationInfoRepositoryEloquent = $associationInfoRepositoryEloquent;
		$this->associationRepositoryEloquent = $associationRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
    }
	public function index(Request $request)
    {
		
		Breadcrumbs::register('admin-association-association_info_index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('社团资讯列表', route('admin.association_info.index'));
		});
		$informations = $this->associationInfoRepositoryEloquent->getInformationAll();
        return view('admin.association.association_info_index', compact('informations'));
    }
	
	public function create(Request $request){
		Breadcrumbs::register('admin-association_info-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-association_info');
            $breadcrumbs->push('编辑社团资讯', route('admin.association_info.create'));
        });
        $associations = $this->associationRepositoryEloquent->getAssociationAll();
        return view('admin.association.association_info_create',compact('associations'));
	}
	
	public function destroy(Request $request){
		var_dump($request->id);exit;
		$result = $this->associationInfoRepositoryEloquent->delete($request->id);
		$info = $this->associationInfoRepositoryEloquent->find($request->id);
		$record = "社团管理，删除社团资讯,资讯内容为：".$info->content;
        $this->adminRecordService->record($record);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function destroy_all(Request $request){
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$info = $this->associationInfoRepositoryEloquent->find($id);
			$record = "社团管理，删除社团资讯,资讯内容为：".$info->content;
	        $this->adminRecordService->record($record);
            $result = $this->associationInfoRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function store(Request $request){
		
		if(empty($request->iid)){
			$record = "社团管理，增加社团资讯,资讯内容为：". $request->content;
	        $this->adminRecordService->record($record);
			$association_info = new Information;
			$association_info->aid = $request->aid;
			$association_info->uid = $request->uid;
			$association_info->title = $request->title;
			$association_info->content = $request->content;
			$association_info->img_url = $request->img_url;
			$association_info->save();	
		}
		header("Location:/admin/association_info");
	}

	public function update(Request $request){
		$info = $this->associationInfoRepositoryEloquent->find($request->iid);
		$record = "社团管理，修改社团资讯,把资讯内容".$info->content."，修改为：".$request->content;
        $this->adminRecordService->record($record);
		Information::where('iid',$request->iid)->update(['title' => $request->title,'content'=>$request->content]);
		header("Location:/admin/association_info");
	}

}
