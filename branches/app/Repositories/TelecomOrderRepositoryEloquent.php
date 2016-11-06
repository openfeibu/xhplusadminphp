<?php

namespace App\Repositories;

use DB;
use App\TelecomOrder;
use App\TelecomPackage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

class TelecomOrderRepositoryEloquent extends BaseRepository implements TelecomOrderRepository
{
	
	public function model()
    {
        return TelecomOrder::class;
    }
	public function getTelecomOrdersExport(Request $request)
	{ 
		return TelecomOrder::select(DB::raw('telecom_order.name as "姓名",telecom_order.package_name as "套餐",telecom_package.package_detail as "套餐详情",telecom_order.major as "（院系）专业",telecom_order.dormitory_no as "宿舍号",telecom_order.student_id as "学号",telecom_order.telecom_phone as "电信手机号码",telecom_order.telecom_iccid as "ICCID",telecom_order.telecom_outOrderNumber as "常用电话",telecom_order.telecom_trade_no as "交易订单号",telecom_order.trade_no as "支付交易号",telecom_order.fee as "金额",telecom_order.idcard as "身份证",if(telecom_order.pay_status=1,"已支付","已退款") as "支付状态",CASE telecom_order.telecom_real_name_status WHEN 0 THEN "未实名" WHEN 1 THEN "已实名" WHEN 2 THEN "实名认证中" END as "实名状态", user.transactor as "办理人编号",user.mobile_no as "办理人手机号码",user.nickname as "办理人昵称",telecom_order.created_at as "创建时间" '))
							->leftJoin('telecom_package', 'telecom_package.package_id', '=', 'telecom_order.package_id')
							->leftJoin('user', 'user.transactor', '=', 'telecom_order.transactor')
							->whereBetween('telecom_order.created_at',[$request->startTime,$request->endTime])->orderBy('id','DESC');				

	}
	public function getTelecomOrders ()
	{
		return TelecomOrder::select(DB::raw('telecom_order.id,user.nickname,user.uid,telecom_order.name ,telecom_order.package_name ,telecom_package.package_detail ,telecom_order.major ,telecom_order.dormitory_no ,telecom_order.student_id ,telecom_order.telecom_phone ,telecom_order.telecom_iccid,telecom_order.telecom_outOrderNumber ,telecom_order.telecom_trade_no,telecom_order.trade_no  ,telecom_order.fee,telecom_order.idcard,telecom_order.pay_status,transactor.transactor,transactor.mobile_no ,telecom_order.created_at,telecom_order.telecom_real_name_status '))
							->leftJoin('telecom_package', 'telecom_package.package_id', '=', 'telecom_order.package_id')
							->leftJoin('user as transactor', 'transactor.transactor', '=', 'telecom_order.transactor')
							->leftJoin('user', 'user.uid', '=', 'telecom_order.uid')
							->orderBy('id','DESC')
							->paginate(config('admin_config.page'));
	}
}