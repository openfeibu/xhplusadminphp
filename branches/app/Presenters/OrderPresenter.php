<?php

namespace App\Presenters;

use App\Transformers\OrderTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrderPresenter
 *
 * @package namespace App\Presenters;
 */
class OrderPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrderTransformer();
    }
	public function orderStatusSelect($task_status)
	{
		$order_status_config = trans('common.task_status');	
		$select = '<select class="form-control" name="trade_status">';		
		foreach($order_status_config as $key => $status){
			if($task_status == $key)
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
