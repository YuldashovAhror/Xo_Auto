<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'photo'=>$this->photo,
            'name'=>$this->name,
            'discription'=>$this->discription,
            'second_photo'=>$this->second_photo,
            'second_discription'=>$this->second_discription,
            'date'=>$this->date,
        ];
    }
}
