<?php

namespace Modules\Users\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\User as BaseModel;
use Illuminate\Notifications\Notifiable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
class User extends BaseModel 
{
use Notifiable,Loggable;
    
    public function receivesBroadcastNotificationsOn()
    {
        return 'Modules.Users.Entities.User.'.$this->id;
    }
}
