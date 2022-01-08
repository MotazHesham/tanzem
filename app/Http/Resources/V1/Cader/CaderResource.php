<?php

namespace App\Http\Resources\V1\Cader;

use Illuminate\Http\Resources\Json\JsonResource;

class CaderResource extends JsonResource
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
            'phone' => $this->phone,  
            'email' => $this->email,  
            'photo' => $image, 
        ];
    }
}
