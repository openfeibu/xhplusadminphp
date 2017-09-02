<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Input;
use Breadcrumbs, Toastr;
use App\Http\Requests;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Repositories\DrivingSchoolRepositoryEloquent;
use App\Repositories\DrivingSchoolProRepositoryEloquent;
use App\Repositories\DrivingSchoolEnrollmentRepositoryEloquent;

class DrivingSchoolController extends BaseController
{
    public function __construct(DrivingSchoolRepositoryEloquent $drivingSchoolRepositoryEloquent,
                                DrivingSchoolProRepositoryEloquent $drivingSchoolProRepositoryEloquent,
                                DrivingSchoolEnrollmentRepositoryEloquent $drivingSchoolEnrollmentRepositoryEloquent,
                                ImageService $imageService)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-drivingSchool', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('驾校管理', route('admin.drivingSchool.index'));
        });
        $this->imageService = $imageService;
        $this->drivingSchoolRepositoryEloquent = $drivingSchoolRepositoryEloquent;
        $this->drivingSchoolProRepositoryEloquent = $drivingSchoolProRepositoryEloquent;
        $this->drivingSchoolEnrollmentRepositoryEloquent = $drivingSchoolEnrollmentRepositoryEloquent;
    }
    public function index()
    {
        Breadcrumbs::register('admin-drivingSchool-index',function($breadcrumbs){
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('驾校列表', route('admin.drivingSchool.index'));
        });
        $driving_schools = $this->drivingSchoolRepositoryEloquent->orderBy('ds_id','desc')->paginate(config('admin_config.page'), $columns = ['*']);

        return view('admin.drivingSchool.index', compact('driving_schools'));
    }
    public function create()
    {
        Breadcrumbs::register('admin-drivingSchool-create', function ($breadcrumbs) {
           $breadcrumbs->parent('admin-drivingSchool');
           $breadcrumbs->push('添加驾校', route('admin.drivingSchool.create'));
       });

       return view('admin.drivingSchool.create');
    }
    public function edit($id)
    {
        Breadcrumbs::register('admin-drivingSchool-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-drivingSchool');
            $breadcrumbs->push('编辑驾校', route('admin.shop.edit', ['id' => $id]));
        });

        $driving_school = $this->drivingSchoolRepositoryEloquent->find($id);
        $productions = $this->drivingSchoolProRepositoryEloquent->get($id);
        return view('admin.drivingSchool.edit', compact('driving_school','productions'));
    }
    public function update(Request $request)
    {
		if(Input::file('uploadfile_logo')){
            $files['uploadfile'] = Input::file('uploadfile_logo');
			$img = $this->imageService->uploadImages($files, 'driving_school');
			if(!$img){
				return redirect(route('admin.drivingSchool.edit', ['id' => $request->id]));
			}
            $logo_url = $img['image_url'];

		}else{
			$logo_url = $request->logo_url;
		}
        if(Input::file('uploadfile_img')){
            $files['uploadfile'] = Input::file('uploadfile_img');
			$img = $this->imageService->uploadImages($files, 'driving_school');
			if(!$img){
				return redirect(route('admin.drivingSchool.edit', ['id' => $request->id]));
			}
			$img_url = $img['image_url'];

		}else{
            $img_url = $request->img_url;
		}

        $result = $this->drivingSchoolRepositoryEloquent->update([
														'name' => $request->name,
														'desc' => $request->desc,
														'content' => $request->content,
														'img_url' => $img_url,
														'logo_url' => $logo_url,
													], $request->id);
		if(!$result) {
            Toastr::error('更新失败');
        } else {
            Toastr::success('更新成功');
        }
        return redirect(route('admin.drivingSchool.edit', ['id' => $request->id]));
    }
    public function store(Request $request)
    {
        if(Input::file('uploadfile_logo')){
            $files['uploadfile'] = Input::file('uploadfile_logo');
			$img = $this->imageService->uploadImages($files, 'driving_school');
			if(!$img){
				return redirect(route('admin.drivingSchool.edit', ['id' => $request->id]));
			}
            $logo_url = $img['image_url'];

		}else{
			$logo_url = '';
		}
        if(Input::file('uploadfile_img')){
            $files['uploadfile'] = Input::file('uploadfile_img');
			$img = $this->imageService->uploadImages($files, 'driving_school');
			if(!$img){
				return redirect(route('admin.drivingSchool.edit', ['id' => $request->id]));
			}
			$img_url = $img['image_url'];

		}else{
            $img_url = '';
		}

        $data = $this->drivingSchoolRepositoryEloquent->create([
            'name' => $request->name,
            'desc' => $request->desc,
            'content' => $request->content,
            'img_url' => $img_url,
            'logo_url' => $logo_url,
		]);
        if(!$data) {
            Toastr::error('创建失败');
			return redirect(route('admin.drivingSchool.create'));
        } else {
            Toastr::success('创建成功');
        }
        return redirect(route('admin.drivingSchool.edit', ['id' => $data->ds_id]));
    }
}
