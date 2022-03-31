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

        if($this->visitor->visitor_type == 'family_individual' && $this->visitor->parent_id != null){
            $parent = $this->visitor->parent ? $this->visitor->parent->user->name : '';
        }else{
            $parent = null;
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'photo' => $image,
            'national' => $this->visitor->national,
            'visitor_type' => $this->visitor->visitor_type,
            'visitor_parent' => $parent ,
            'visitor_family' => VisitorFamilyResource::collection($this->visitor->visitorVisitorsFamilies),
        ];
    }
}
