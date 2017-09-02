<?php

namespace App\Services;

use Validator;
use App\TradeAccount;
use Toastr;
use Redirect;
use Illuminate\Http\Request;

class HelpService
{

	protected $request;

	function __construct(Request $request)
	{
		$this->request = $request;
	}

	/**
	 * 检验请求参数
	 */
	public function validateParameter($rules)
	{
		$validator = Validator::make($this->request->all(), $rules);
        if ($validator->fails()) {
    		$missingParamters = '';
    		if (config('app.debug')) {
        		$missingParamter = array_keys(array_diff_key($rules, $validator->valid()));
        		foreach ($missingParamter as $p) {
        			$missingParamters .= $p . ' ';
        		}
    		}

    		throw new \App\Exceptions\Custom\OutputServerMessageException($validator->errors()->first());
        } else {
        	return true;
        }
	}
	public function validateData ($value,$custom)
	{
		if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$value)){
			throw new \App\Exceptions\Custom\OutputServerMessageException($custom."含非法参数");
		}
		return true;
	}
    public function buildOrderSn($prefix = ''){

        $out_trade_no = $prefix.'XH'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        if(TradeAccount::where('out_trade_no',$out_trade_no)->first()){
	        $out_trade_no = buildOrderSn($prefix);
        }
        return $out_trade_no;
    }

    public function serviceFee ($total_fee)
    {
    	return ($total_fee * 0.02) > 0.01 ? ($total_fee * 0.02) : 0.01;
    }
    public function applyServiceFee ($fee)
    {
    	return 0;
    }
    public function moneyHandle ($money,$type,$prefix = false ,$suffix = false)
    {
	    $money = $money ;
	    if($prefix){
		    $money = "￥".$money;
	    }else if($suffix){
		     $money .= "元";
	    }
    	if($type == 1){
	    	$money = '+'.$money;
    	}else if($type == -1){
	    	$money = '-'.$money;
    	}
    	return $money;
    }
    public function do_hash($psw) {
	    $salt = 'xiaohuifdsafagfdgv43532ju76jM';
	    return md5($psw . $salt);
	}
	public function handlePayPassword ($pay_password)
	{
		//$options = [
		// 'salt' => custom_function_for_salt(),
		// 'cost' => 2
		//];
		$hash = password_hash($pay_password, PASSWORD_BCRYPT);
		return $hash;
	}
	public function handleRealName ($file_contents)
	{
		$contents = str_replace('(','',trim($file_contents));
		$contents = str_replace(')','',$file_contents);
		$contents = json_decode($file_contents);
		return $contents;
	}
	public function buildBatchNo(){

        $batch_no = date("YmdHis",time()).substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

        return $batch_no;
    }
	public function isVaildImage($files)
	{
		$error = '';

		foreach($files as $key => $file)
		{
			$name = $file->getClientOriginalName();
			if(!$file->isValid())
			{
				$error.= $name.$file->getErrorMessage().';';
			}
			if(!in_array( strtolower($file->extension()),config('common.img_type'))){
				$error.= $name."类型错误;";
			}
			if($file->getClientSize() > config('common.img_size')){
				$img_size = config('common.img_size')/1024;
				$error.= $name.'超过'.$img_size.'M';
			}
		}
		if($error)
		{
			Toastr::error($error);
			return false;
		}
		return true;

	}
}
