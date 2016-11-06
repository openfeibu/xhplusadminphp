<?php

namespace App\Presenters;

use App\Transformers\ShopPresenterTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ShopPresenterPresenter
 *
 * @package namespace App\Presenters;
 */
class ShopPresenterPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ShopPresenterTransformer();
    }
}
