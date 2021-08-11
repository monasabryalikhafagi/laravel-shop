<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
   
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded =[
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(\Midade\Users\Models\User::class);
    }

}
