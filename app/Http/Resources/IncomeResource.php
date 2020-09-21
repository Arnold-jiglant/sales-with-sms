<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id'=>$this->id,
            'amount'=>$this->amount,
            'desc'=>$this->description??'',
            'issuer'=>$this->user->name,
            'date'=>$this->created_at->format('d-M-Y H:i')
        ];
    }
}
