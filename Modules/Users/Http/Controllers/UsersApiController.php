<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class UsersApiController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['login', 'register', 
       // 'forgotPassword', 'resetPassword'
        ]]);

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register(Request $request)
    {
        //validate incoming request
        $request->validate([
            'name' => 'required|min:3|max:250',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:50',

        ]);
        return response()->json(['message' => 'hello'], 201);

        try {

            $user = new User;
            $user->code = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
            $user->save();
            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    public function login(Request $request)
    {

        //validate incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:50',
        ]);

      
        $credentials=$request->all();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
