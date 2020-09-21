<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->description ?? '',
            'incomes' => $this->incomes()->orderByDesc('created_at')->limit(20)->get()->transform(function ($income) {
                return new IncomeResource($income);
            }),
        ];
    }
}
