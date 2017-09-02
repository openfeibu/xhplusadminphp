<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Input;
use Breadcrumbs, Toastr;
use App\Http\Requests;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use App\Repositories\EducationRepositoryEloquent;
use App\Repositories\EducationProRepositoryEloquent;
use App\Repositories\EducationEnrollmentRepositoryEloquent;

class EducationController extends BaseController
{
    public function __construct(EducationRepositoryEloquent $educationRepositoryEloquent,
                                EducationProRepositoryEloquent $educationProRepositoryEloquent,
                                EducationEnrollmentRepositoryEloquent $educationEnrollmentRepositoryEloquent,
                                ImageService $imageService)
    {
        parent::__construct();
        Breadcrumbs::setView('admin._partials.breadcrumbs');
        Breadcrumbs::register('admin-education', function ($breadcrumbs) {
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('驾校管理', route('admin.education.index'));
        });
        $this->imageService = $imageService;
        $this->educationRepositoryEloquent = $educationRepositoryEloquent;
        $this->educationProRepositoryEloquent = $educationProRepositoryEloquent;
        $this->educationEnrollmentRepositoryEloquent = $educationEnrollmentRepositoryEloquent;
    }
    public function index()
    {
        Breadcrumbs::register('admin-education-index',function($breadcrumbs){
            $breadcrumbs->parent('dashboard');
            $breadcrumbs->push('驾校列表', route('admin.education.index'));
        });
        $educations = $this->educationRepositoryEloquent->orderBy('edu_id','desc')->paginate(config('admin_config.page'), $columns = ['*']);

        return view('admin.education.index', compact('educations'));
    }
    public function create()
    {
        Breadcrumbs::register('admin-education-create', function ($breadcrumbs) {
           $breadcrumbs->parent('admin-education');
           $breadcrumbs->push('添加驾校', route('admin.education.create'));
       });

       return view('admin.education.create');
    }
    public function edit($id)
    {
        Breadcrumbs::register('admin-education-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-education');
            $breadcrumbs->push('编辑驾校', route('admin.shop.edit', ['id' => $id]));
        });

        $education = $this->educationRepositoryEloquent->find($id);
        $productions = $this->educationProRepositoryEloquent->get($id);
        return view('admin.education.edit', compact('education','productions'));
    }
    public function update(Request $request)
    {
		if(Input::file('uploadfile_logo')){
            $files['uploadfile'] = Input::file('uploadfile_logo');
			$img = $this->imageService->uploadImages($files, 'education');
			if(!$img){
				return redirect(route('admin.education.edit', ['id' => $request->id]));
			}
            $logo_url = $img['image_url'];

		}else{
			$logo_url = $request->logo_url;
		}
        if(Input::file('uploadfile_img')){
            $files['uploadfile'] = Input::file('uploadfile_img');
			$img = $this->imageService->uploadImages($files, 'education');
			if(!$img){
				return redirect(route('admin.education.edit', ['id' => $request->id]));
			}
			$img_url = $img['image_url'];

		}else{
            $img_url = $request->img_url;
		}

        $result = $this->educationRepositoryEloquent->update([
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
        return redirect(route('admin.education.edit', ['id' => $request->id]));
    }
    public function store(Request $request)
    {
        if(Input::file('uploadfile_logo')){
            $files['uploadfile'] = Input::file('uploadfile_logo');
			$img = $this->imageService->uploadImages($files, 'education');
			if(!$img){
				return redirect(route('admin.education.edit', ['id' => $request->id]));
			}
            $logo_url = $img['image_url'];

		}else{
			$logo_url = '';
		}
        if(Input::file('uploadfile_img')){
            $files['uploadfile'] = Input::file('uploadfile_img');
			$img = $this->imageService->uploadImages($files, 'education');
			if(!$img){
				return redirect(route('admin.education.edit', ['id' => $request->id]));
			}
			$img_url = $img['image_url'];

		}else{
            $img_url = '';
		}

        $data = $this->educationRepositoryEloquent->create([
            'name' => $request->name,
            'desc' => $request->desc,
            'content' => $request->content,
            'img_url' => $img_url,
            'logo_url' => $logo_url,
		]);
        if(!$data) {
            Toastr::error('创建失败');
			return redirect(route('admin.education.create'));
        } else {
            Toastr::success('创建成功');
        }
        return redirect(route('admin.education.edit', ['id' => $data->edu_id]));
    }
}
