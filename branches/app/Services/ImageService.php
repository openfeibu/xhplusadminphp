<?php

namespace App\Services;

use Log;
use File;
use Storage;
use Illuminate\Http\Request;
use App\Services\HelpService;
use App\Services\QiniuService;

class ImageService
{

	protected $request;

	protected $userRepository;

	protected $imageRepository;

	protected $helpService;

	function __construct(Request $request,
						 HelpService $helpService ,
						 QiniuService $qiniuService)
	{
		$this->request = $request;

		$this->helpService = $helpService;
		$this->qiniuService = $qiniuService;
	}
	/**
	 * 上传图片
	 * 注意：用户必须是已登录状态
	 *
	 * @param  file $files  要上传的图片文件
	 * @param  string $usage 图片的用途，并将上传的图片文件存放到public/uploads/$usage中
	 *
	 * @return array        图片链接
	 */
	public function uploadImages($files, $usage,$thumb = 1,$id = 0)
	{
		if(is_array($files['uploadfile']))
		{
			$all_files = $files['uploadfile'];
		}
		else{
			$all_files[] = $files['uploadfile'];
		}
		$status = $this->helpService->isVaildImage($all_files);
		if(!$status)
		{
			return false;
		}
		return $this->qiniuService->uploadImages($all_files, $usage,$id,$thumb);
	}
}
