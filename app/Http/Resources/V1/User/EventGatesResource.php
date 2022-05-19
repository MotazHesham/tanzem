<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class EventGatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'gate' => $this->gate,
            'description' => $this->description ?? '' ,
            'zone_name' => $this->zone_name ?? '' ,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
