<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\TradeAccount;

/**
 * Class TradeAccountTransformer
 * @package namespace App\Transformers;
 */
class TradeAccountTransformer extends TransformerAbstract
{

    /**
     * Transform the \TradeAccount entity
     * @param \TradeAccount $model
     *
     * @return array
     */
    public function transform(TradeAccount $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
