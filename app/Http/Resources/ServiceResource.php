<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'slug'=>$this->slug,
            'video'=> env('APP_URL').$this->video,
            'name'=>$this->name,
            'title'=>$this->title,
            'discription'=>$this->discription,
            'atribute'=>$this->atribute,
            'second_video'=> env('APP_URL').$this->video,
        ];
    }
}
