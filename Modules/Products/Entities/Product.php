<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded =[
        'id'
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(\Midade\Users\Models\User::class);
    }

}
