<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;


class Socialauth extends Model
{
   
    protected $table="socialauth";
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
