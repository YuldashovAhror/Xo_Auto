<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HelpCenterResource extends JsonResource
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
            'video'=>env('APP_URL').$this->video,
            'second_video'=>env('APP_URL').$this->second_video,
            'atribute'=>$this->atribute,
        ];
    }
}
