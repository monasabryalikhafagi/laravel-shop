<?php

namespace Modules\Orders\Entities;

use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
   
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded =[
        'id'
    ];



}
