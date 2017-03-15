<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('buildOrderSn')) {
    /**
     * Create a new back url.
     *
     * @param string|null $route
     * @param array       $parameters
     * @param int         $status
     * @param array       $headers
     *
     * @return string
     */
    function buildOrderSn($prefix = ''){

        $out_trade_no = $prefix.'XH'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        if(TradeAccount::where('out_trade_no',$out_trade_no)->first()){
	        $out_trade_no = buildOrderSn($prefix);
        }
        return $out_trade_no;
    }
}
if (!function_exists('buildBatchNo')) {
    /**
     * Create a new back url.
     *
     * @param string|null $route
     * @param array       $parameters
     * @param int         $status
     * @param array       $headers
     *
     * @return string
     */
    function buildBatchNo($prefix = ''){

        $batch_no = date("YmdHis",time()).substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

        return $out_trade_no;
    }
}

if (!function_exists('check_refund_order_info')) {
	function check_refund_order_info($pay_status,$shipping_status,$order_status)
	{
		if($pay_status !=1 || $shipping_status !=0 || $order_status >=2 ){
			return false;
		}
		return true;
	}
}
if (!function_exists('dtime')) {
	function dtime($time = '')
	{
		if($time){
			return date('Y-m-d H:i:s',$time);
		}
		return date('Y-m-d H:i:s');
	}
}
if (!function_exists('seller_check_refund_order_info')) {
	function seller_check_refund_order_info($pay_status,$shipping_status,$order_status)
	{
		if($pay_status !=1 || $shipping_status !=0 || $order_status !=3 ){
			return false;
		}
		return true;
	}
}
if (!function_exists('check_confirm_order_info')) {
	function check_confirm_order_info ($pay_status,$shipping_status,$order_status)
	{
		if($pay_status !=1 || $shipping_status !=1 || $order_status >=2 ){
			return false;
		}
		return true;
	}
}
if (!function_exists('seller_check_Shipping_order_info')) {
	function seller_check_Shipping_order_info ($pay_status,$shipping_status,$order_status)
	{
		if($pay_status !=1 || $shipping_status !=0 || $order_status >=2 ){
			return false;
		}
		return true;
	}
}

