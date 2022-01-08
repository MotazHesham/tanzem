<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $image = $this->photo ? asset($this->photo->getUrl()) : null;
        $image = str_replace('public/public','public',$image);
        $name = 'name_' . app()->getLocale();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address ?? '' ,
            'description' => $this->description ?? '' ,
            'city' => $this->city->$name ?? '' ,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,  
            'photo' => $image, 
            'gates' => EventGatesResource::collection($this->available_gates),
            'brands' => BrandsResource::collection($this->eventBrands)
        ];
    }
}
