<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseTypeResource extends JsonResource
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
            'name' => $this->name,
            'desc' => $this->description ?? '',
            'expenses' => $this->expenses()->orderByDesc('created_at')->limit(20)->get()->transform(function ($income) {
                return new ExpenseResource($income);
            }),
        ];
    }
}
