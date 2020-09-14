<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceiptResource extends JsonResource
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
            'number' => $this->number,
            'requiredAmount' => $this->requiredPaymentAmount,
            'payedAmount' => $this->payedAmount,
            'debtAmount' => $this->debtAmount,
            'issueDate' => $this->created_at->format('D d-M-Y H:i'),
            'issuer' => $this->user->name,
            'paymentType' => $this->paymentType->name,
            'customer'=>$this->customerName,
            'products' => $this->sales()->get()->transform(function ($sale) {
                return new SaleResource($sale);
            }),
        ];
    }
}
