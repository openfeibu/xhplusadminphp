<?php

namespace App\Services;

use Illuminate\Http\Request;

class ImagesService
{

	public function upload($file,$request){
		
		$path = 'uploads/admin-img/';
		if(!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		
		$file_name = $file->getClientOriginalName();
		$file_size = round($file->getSize() / 1024);
		$file_ex = $file->getClientOriginalExtension();
		$file_mime = $file->getMimeType();
		if (!in_array($file_ex, array('jpg', 'gif', 'png'))) return Redirect::to('/')->withErrors('Invalid image extension we just allow JPG, GIF, PNG');
		$newname = md5(time()).random_int(5,5).'.jpg';
		$file->move($path , $newname);
		
		return $url = $request->getSchemeAndHttpHost().$request->getBasePath().'/'.$path.$newname;
	}

}