<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'name' => $this->productName,
            'qty' => $this->quantity,
            'price' => $this->afterDiscountPrice,
            'amount' => $this->payedAmount,
        ];
    }
}
