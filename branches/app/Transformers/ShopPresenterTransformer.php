<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\ShopPresenter;

/**
 * Class ShopPresenterTransformer
 * @package namespace App\Transformers;
 */
class ShopPresenterTransformer extends TransformerAbstract
{

    /**
     * Transform the \ShopPresenter entity
     * @param \ShopPresenter $model
     *
     * @return array
     */
    public function transform(ShopPresenter $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
