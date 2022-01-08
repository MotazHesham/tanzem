<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
        return [ 
            'id' => $this->id, 
            'name' => $this->name, 
            'email' => $this->email, 
            'phone' => $this->phone, 
            'photo' => $image, 
            'national' => $this->visitor->national, 
            'visitor_family' => VisitorFamilyResource::collection($this->visitor->visitorVisitorsFamilies),
        ];
    }
}
