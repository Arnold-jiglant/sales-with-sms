<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LossResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'invProdId' => $this->inventory_product_id,
            'qty' => $this->quantity,
            'amount' => $this->amount,
            'description' => $this->description ?? '',
            'date' => $this->created_at->format('d/m/Y'),
        ];
    }
}
