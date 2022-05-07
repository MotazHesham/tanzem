<?php

namespace App\Http\Resources\V1\Cader;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      $photo= $this;

      if($photo){
        $image = $photo ? asset($photo->getUrl()) : null;
        $image = str_replace('public/public','public',$image);
     }
   else
        $image='';
       return [

         'image'=>$image,

       ];
   }
}
