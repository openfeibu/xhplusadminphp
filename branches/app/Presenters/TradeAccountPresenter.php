<?php

namespace App\Presenters;

use App\Transformers\TradeAccountTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TradeAccountPresenter
 *
 * @package namespace App\Presenters;
 */
class TradeAccountPresenter extends FractalPresenter
{
	
	public function __construct()
	{
		
	}
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TradeAccountTransformer();
    }
	
	public function tradeStatusSelect($trade_status)
	{
		$trade_status_config = trans('common.trade_status');		
		$select = '<select class="form-control" name="trade_status">';		
		foreach($trade_status_config as $key => $status){
			if($trade_status == $key)
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
