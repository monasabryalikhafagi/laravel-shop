<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Users\Http\Resources\User as UserResource;
use Auth;
use Modules\Users\Entities\User;
use Modules\Users\Http\Requests\UpdateUserProfileRequest;
class UsersApiController extends Controller
{
    public function getProfile( )
    {

        return new UserResource(Auth::user());
      
    }
    
    public function postProfile( UpdateUserProfileRequest $request)
    {
        User::where('id',Auth::id())
                ->update($request->all());

        return new UserResource(Auth::user());
      
    }

}
