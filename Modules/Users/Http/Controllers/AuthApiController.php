<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;
use Modules\Users\Entities\Socialauth;
use Modules\Users\Entities\User;

class AuthApiController extends Controller
{

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

        $credentials = $request->all();

        if (!$token = auth('api')->attempt($credentials)) {
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
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function socialLogin($provider)
    {

        $user = Socialite::driver($provider)->stateless()->user();
        $checkUser = User::where('email', $user->getEmail())->first();
        if ($checkUser) {
            $socialauthUser = Socialauth::where('user_id', $checkUser->id)->first();
            $socialauthUser->token = $user->token;
            $socialauthUser->save();

            return response()->json($socialauthUser, 200);
        }
        $createUseNeededData = [
            "name" => $user->getName(),
            "email" => $user->getEmail(),
        ];
        $createdUser = User::create($createUseNeededData);

        if ($createdUser) {

            $socialauth = Socialauth::create([
                'user_id' => $createdUser->id,
                'provider' => $provider,
                'auth_id' => $user->getId(),
                'token' => $user->token,
                'avatar' => $user->getAvatar(),
            ]);
            if ($socialauth) {
                return response()->json($createdUser, 200);
            }

        }

        return response()->json(["message" => "Some thing went rong"], 500);

    }
}
