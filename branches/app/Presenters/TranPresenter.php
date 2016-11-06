<?php

namespace App\Presenters;

use App\Transformers\TranTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TranPresenter
 *
 * @package namespace App\Presenters;
 */
class TranPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TranTransformer();
    }
	
	public function getTrans($key,$value)
	{
		return trans("common.$key.$value");
	}
}
