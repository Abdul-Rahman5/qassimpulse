<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailsPlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "type"=>$this->type,
            "data"=>$this->data,
            "evaluation"=>$this->evaluation,
            "contact"=>$this->contact,
            "timeVisit"=>$this->timeVisit,
            "images"=>asset("storage")."/".$this->images,
        ];
    }
}
