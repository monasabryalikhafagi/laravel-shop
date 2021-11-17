<?php

namespace Modules\Products\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Products extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public $preserveKeys = true;

    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
        'id'=>$this->collection,
        'meta'=>[
            "key"=>"value"
        ],
     

    ];
    }
}
