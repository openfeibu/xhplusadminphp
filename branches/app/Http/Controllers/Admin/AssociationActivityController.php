<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Breadcrumbs, Toastr;
use DB;
use App\Activity;
use App\Repositories\AssociationActivityRepositoryEloquent;
use App\Repositories\AssociationRepositoryEloquent;
use App\Services\AdminRecordService;
use App\Services\ImagesService;
use Input;


class AssociationActivityController extends BaseController
{
	protected $associationActivityRepositoryEloquent;
	protected $associationRepositoryEloquent;
	protected $imagesService;
	
    public function __construct(AssociationActivityRepositoryEloquent $associationActivityRepositoryEloquent,
    							AssociationRepositoryEloquent $associationRepositoryEloquent,
    							AdminRecordService $adminRecordService,
								ImagesService $imagesService)
    {
        parent::__construct();

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-association_activity', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('社团活动管理', route('admin.association_activity.index'));
        });
		
		$this->associationActivityRepositoryEloquent = $associationActivityRepositoryEloquent;
		$this->associationRepositoryEloquent = $associationRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		$this->imagesService = $imagesService;
    }
	public function index(Request $request)
    {
		
		Breadcrumbs::register('admin-association-association_activity_index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('社团活动列表', route('admin.association_activity.index'));
		});
		$activities = $this->associationActivityRepositoryEloquent->getActivityAll();
        return view('admin.association.association_activity_index', compact('activities'));
    }
	
	public function create(Request $request){
		Breadcrumbs::register('admin-association_activity-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-association_activity');
            $breadcrumbs->push('添加社团活动', route('admin.association_activity.create'));
        });
        $associations = $this->associationRepositoryEloquent->getAssociationAll();
        return view('admin.association.association_activity_create',compact('associations'));
	}
	
	public function destroy(Request $request){
		$result = $this->associationActivityRepositoryEloquent->delete($request->id);
		$associationActivity = $this->associationActivityRepositoryEloquent->find($request->id);
		$record = "社团活动管理，删除社团活动,活动内容为：".$associationActivity->content;
        $this->adminRecordService->record($record);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function destroy_all(Request $request){
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$associationActivity = $this->associationActivityRepositoryEloquent->find($id);
			$record = "社团活动管理，删除社团活动,活动内容为：".$associationActivity->content;
	        $this->adminRecordService->record($record);
            $result = $this->associationActivityRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function store(Request $request){
		
		$url = $this->imagesService->upload(Input::file("activity_url"),$request);
		
		$association_activity = new Activity;
		$association_activity->aid = $request->aid;
		$association_activity->uid = $request->uid;
		$association_activity->title = $request->title;
		$association_activity->content = $request->content;
		$association_activity->start_time = $request->start_time;
		$association_activity->end_time = $request->end_time;
		$association_activity->place = $request->place;
		$association_activity->img_url = $url;
		$association_activity->save();	

		$record = "社团活动管理，添加社团活动,活动内容为：".$request->content;
        $this->adminRecordService->record($record);
		header("Location:/admin/association_activity");
	}

	public function update(Request $request){
		$association_activity = Activity::where('actid',$request->actid)->first();
		$record = "社团活动管理，修改社团活动,活动内容:".$association_activity->content."修改为：".$request->content;
        $this->adminRecordService->record($record);
		Activity::where('actid',$request->actid)->update([
			'title' => $request->title,
			'content'=>$request->content,
			'start_time'=>$request->start_time,
			'end_time'=>$request->end_time,
			'place'=>$request->place
			]);
		
		header("Location:/admin/association_activity");
	}
}
