<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use Breadcrumbs, Toastr;
use DB;
use App\Association;
use App\User;
use App\UserInfo;
use App\AssociationMember;
use App\Repositories\AssociationRepositoryEloquent;
use App\Services\AdminRecordService;
use Input;
use App\Services\ImagesService;

class AssociationController extends BaseController
{
	protected $associationRepositoryEloquent;
	protected $adminRecordService;
	protected $imagesService;
	
    public function __construct(AssociationRepositoryEloquent $associationRepositoryEloquent,
    							AdminRecordService $adminRecordService,
								ImagesService $imagesService)
    {
        parent::__construct();

        Breadcrumbs::setView('admin._partials.breadcrumbs');

        Breadcrumbs::register('admin-association', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('社团管理', route('admin.association.index'));
        });
		
		$this->associationRepositoryEloquent = $associationRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		$this->imagesService = $imagesService;
    }
	public function index(Request $request)
    {
		
		Breadcrumbs::register('admin-association-index',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('社团列表', route('admin.association.index'));
		});
		$associations = $this->associationRepositoryEloquent->getAssociationAll();
        return view('admin.association.index', compact('associations'));
    }
	
	public function create(Request $request){
		Breadcrumbs::register('admin-association-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-association');
            $breadcrumbs->push('编辑社团', route('admin.association.create'));
        });
        $association = $request->session()->get("association");
		$request->session()->put("association","");
		$labels = $this->associationRepositoryEloquent->getAccusationLabel();
        return view('admin.association.create',compact('association','labels'));
	}
	
	public function edit(Request $request)
    {
        Breadcrumbs::register('admin-association-edit', function ($breadcrumbs){
            $breadcrumbs->parent('admin-association');
            $breadcrumbs->push('编辑社团', route('admin.association.edit', ['id' => $request->id]));
        });
		$association = $this->associationRepositoryEloquent->getAssociationOne($request->id);
		$request->session()->put("association",$association);
		return redirect('admin/association/create');
    }
	
	public function destroy(Request $request){
		$association = $this->associationRepositoryEloquent->find($request->id);
		$record = "社团管理，删除社团,社团名字为：".$association->aname;
        $this->adminRecordService->record($record);
		$result = $this->associationRepositoryEloquent->delete($request->id);
		return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function destroy_all(Request $request){
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }
        foreach($ids as $id){
        	$association = $this->associationRepositoryEloquent->find($id);
			$record = "社团管理，删除社团,社团名字为：".$association->aname;
	        $this->adminRecordService->record($record);
            $result = $this->associationRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	
	public function store(Request $request){
		$user = User::where('mobile_no',$request->leader_mobile)->first();
		
		if(empty(Input::file("background_url")) || empty($request->label) || empty($request->aname || empty(Input::file("avatar_url")) || empty($request->introduction))){
			echo "<script>alert('信息还没填写完整');history.go(-1);</script>";exit;
		}

		if($user){
			$userInfo = UserInfo::where('uid',$user->uid)->first();
			if(!empty($userInfo->realname)){
				if(empty($request->aid)){
					$url = $this->imagesService->upload(Input::file("avatar_url"),$request);
					$background_url = $this->imagesService->upload(Input::file("background_url"),$request);
					
					$association = new Association;
					$association->aname = $request->aname;
					$association->avatar_url = $url;
					$association->leader_uid = $userInfo->uid;
					$association->leader = $userInfo->realname;
					$association->background_url = $background_url;
					$association->label = $request->label;
					$association->member_number = 1;
					$association->introduction = $request->introduction;
					$association->superior = $request->superior;
					$association->save();

					$new_association = Association::orderBy('aid', 'desc')->first();
					$associationMember = new AssociationMember;
					$associationMember->aid = $new_association->aid;
					$associationMember->uid = $userInfo->uid;
					$associationMember->level = 1;
					$associationMember->save();

					$record = "社团管理，添加社团,社团名字为：".$request->aname;
			        $this->adminRecordService->record($record);	
					
				}else{
					Association::where('aid',$request->aid)->update([
						"aname" => $request->aname,
						"avatar_url" => $request->avatar_url,
						"background_url" => $request->background_url,
						"leader_uid" => $userInfo->uid,
						"leader" => $request->$userInfo->realname,
						"label" => $request->label,
						"introduction" => $request->introduction,
						"superior" => $request->superior,
					]);
					$association = Association::where('aid',$request->aid)->first();
					$record = "社团管理，修改社团,社团名字为：".$association->aname;
			        $this->adminRecordService->record($record);	
				}
				header("Location:/admin/association");
			}else{
				Toastr::error("社长还未实名，请先实名再创建社团");
				return redirect(route('admin.association.create'));
			}
		}else{
			Toastr::error("手机号码不是社长注册的号码");
			return redirect(route('admin.association.create'));
		}
		
	}

}
