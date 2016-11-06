<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\ApplyWallet;

/**
 * Class ApplyWalletTransformer
 * @package namespace App\Transformers;
 */
class ApplyWalletTransformer extends TransformerAbstract
{

    /**
     * Transform the \ApplyWallet entity
     * @param \ApplyWallet $model
     *
     * @return array
     */
    public function transform(ApplyWallet $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
