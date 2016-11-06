<?php

namespace App\Presenters;

use App\Transformers\ApplyWalletTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ApplyWalletPresenter
 *
 * @package namespace App\Presenters;
 */
class ApplyWalletPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ApplyWalletTransformer();
    }
	public function applyWalletStatusSelect($apply_status)
	{
		$apply_status_config = trans('common.apply_wallet_status');		
		$select = '<select class="form-control" name="status">';		
		foreach($apply_status_config as $key => $status){
			if($apply_status == $key)
			{				
				$select .= '<option value="'.$key.'" selected>'.$status.'</option>';
			}else{
				$select .= '<option value="'.$key.'">'.$status.'</option>';
			}
		}
		$select .='</select>';
		return $select;
	}
}
