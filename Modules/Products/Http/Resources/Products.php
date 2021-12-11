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
        return parent::toArray($request);
    //    return [
    //     'data'=>$this->collection,
    //     'links'=>[
    //         'first'=> $this->firstItem(),
    //         'last'=> $this->lastItem(),
    //         'prev'=> $this->previousPageUrl(),
    //         'next'=> $this->nextPageUrl()
    //     ],
    //     'meta'=>[
    //         'current_page'=> $this->currentPage(),
    //         'last_page'=> $this->lastItem(),
    //         'path'=> $this->path(),
    //         'per_page'=> $this->perPage(),
    //         "total"=>$this->total(),
    //     ]

    // ];
    }
    public function with($request)
    {
        return[
        'links'=>[
            'first'=> $this->firstItem(),
            'last'=> $this->lastItem(),
            'prev'=> $this->previousPageUrl(),
            'next'=> $this->nextPageUrl()
        ],
        'meta'=>[
            'current_page'=> $this->currentPage(),
            'last_page'=> $this->lastItem(),
            'path'=> $this->path(),
            'per_page'=> $this->perPage(),
            "total"=>$this->total(),
        ]
        ];
    }
}
