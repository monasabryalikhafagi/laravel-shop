<?php

namespace Modules\Users\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\User as BaseModel;
use Illuminate\Notifications\Notifiable;
class User extends BaseModel 
{
use Notifiable;
    
    public function receivesBroadcastNotificationsOn()
    {
        return 'Modules.Users.Entities.User.'.$this->id;
    }
}
