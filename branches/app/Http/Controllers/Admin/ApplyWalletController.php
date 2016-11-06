<?php

namespace App\Http\Controllers\Admin;

use Input;
use Illuminate\Http\Request;
use Breadcrumbs, Toastr;
use App\ApplyWallet;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ApplyWalletRepositoryEloquent;
use App\Repositories\TradeAccountRepositoryEloquent;
use App\Repositories\WalletAccountRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Services\MessageService;
use App\Services\AdminRecordService;


class ApplyWalletController extends BaseController
{
    protected $applyWalletRepositoryEloquent;
	
	protected $tradeAccountRepositoryEloquent;

	protected $messageService;

	protected $userRepositoryEloquent;

	protected $walletAccountRepositoryEloquent;

	protected $adminRecordService;
	
	public function __construct(ApplyWalletRepositoryEloquent $applyWalletRepositoryEloquent,
								TradeAccountRepositoryEloquent $tradeAccountRepositoryEloquent,
								WalletAccountRepositoryEloquent $walletAccountRepositoryEloquent,
								UserRepositoryEloquent $userRepositoryEloquent,
								MessageService $messageService,
								AdminRecordService $adminRecordService)
	{
		parent::__construct();
		$this->applyWalletRepositoryEloquent = $applyWalletRepositoryEloquent;
		$this->tradeAccountRepositoryEloquent = $tradeAccountRepositoryEloquent;
		$this->walletAccountRepositoryEloquent = $walletAccountRepositoryEloquent;
		$this->messageService = $messageService;
		$this->userRepositoryEloquent = $userRepositoryEloquent;
		$this->adminRecordService = $adminRecordService;
		Breadcrumbs::setView('admin._partials.breadcrumbs');
		Breadcrumbs::register('admin-applyWallet',function($breadcrumbs){
			$breadcrumbs->parent('dashboard');
			$breadcrumbs->push('提现申请', route('admin.applyWallet.index'));
		});
	}
	public function index()
	{
		Breadcrumbs::register('admin-applyWallet-index',function($breadcrumbs){
			$breadcrumbs->parent('admin-applyWallet');
			$breadcrumbs->push('提现申请', route('admin.applyWallet.index'));
		});
		$applyWallets = $this->applyWalletRepositoryEloquent->scopeQuery(function($query){
			return $query->orderBy('apply_id','desc');
		})->paginate(config('admin_config.page'));

        return view('admin.applyWallet.index', compact('applyWallets'));
	}
	public function create()
	{
		
	}	
	public function store(Request $request)
	{
		
	}
	public function edit($id)
	{
		Breadcrumbs::register('admin-applyWallet-edit',function($breadcrumbs) use ($id){
			$breadcrumbs->parent('admin-applyWallet');
			$breadcrumbs->push('编辑提现记录', route('admin.applyWallet.edit', ['id' => $id]));
		});
		$applyWallet = $this->applyWalletRepositoryEloquent->find($id,$columns = ['apply_id','status','description']);
        return view('admin.applyWallet.edit', compact('applyWallet'));
	}
	public function update($id)
	{		
		$applyWallet = $this->applyWalletRepositoryEloquent->find($id,$columns = ['uid','out_trade_no','status','fee']);

		
		if($applyWallet->status != 'wait')
		{
			Toastr::error('请勿重复操作提现申请');
		}
		else
		{
			$result = $this->applyWalletRepositoryEloquent->update( Input::all(), $id );
			$trade = $this->tradeAccountRepositoryEloquent->findByField('out_trade_no',$applyWallet->out_trade_no,$columns = ['id','uid','out_trade_no','trade_status','fee'])->first();
			if(Input::get('status') == 'success' && isset($trade) && $trade->trade_status == 'cashing')
			{
				$this->tradeAccountRepositoryEloquent->update(['trade_status'=>'cashed'],$trade->id);
				$content = "您的提现申请已审核通过,请注意查收支付宝";
				$this->messageService->SystemMessage2SingleOne($applyWallet->uid, $content);
				$record = "提现管理，通过提现用户,用户id为：".$applyWallet->uid;
		        $this->adminRecordService->record($record);
			}
			if(Input::get('status') == 'failed' && isset($trade) && $trade->trade_status == 'cashing'){
				$this->tradeAccountRepositoryEloquent->update(['trade_status'=>'cashfail','wallet_type' => 1],$trade->id);				
				$wallet = $this->userRepositoryEloquent->getUserWallet($applyWallet->uid);
				$this->applyWalletRepositoryEloquent->updateWallet( $applyWallet->uid, $wallet + $trade->fee );
				$this->walletAccountRepositoryEloquent->updateTradeType( ['trade_type' => 'WithdrawalsFail','wallet_type' => 1,'wallet' => $wallet + $trade->fee ],$applyWallet->out_trade_no );
				$content = "您的提现申请审核失败，".$result["description"];
				$this->messageService->SystemMessage2SingleOne($applyWallet->uid, $content);
				$record = "提现管理，驳回提现用户,用户id为：".$applyWallet->uid;
		        $this->adminRecordService->record($record);
			}
			Toastr::success('提现记录更新成功');
		}

        return redirect(route('admin.applyWallet.edit', ['id' => $id]));
	}
	public function destroy($id)
	{
		$applyWallet = $this->applyWalletRepositoryEloquent->find($id);
		$record = "提现管理，删除提现用户,用户id为：".$applyWallet->uid;
        $this->adminRecordService->record($record);
		$result = $this->applyWalletRepositoryEloquent->delete($id);
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
	public function destroyall(Request $request)
	{
		if(!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach($ids as $id){
        	$applyWallet = $this->applyWalletRepositoryEloquent->find($id);
			$record = "提现管理，删除提现用户,用户id为：".$applyWallet->uid;
	        $this->adminRecordService->record($record);
            $result = $this->applyWalletRepositoryEloquent->delete($id);
        }
        return response()->json($result ? ['status' => 1] : ['status' => 0]);
	}
}
