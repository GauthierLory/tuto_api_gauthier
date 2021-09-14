<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '';
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws ValidationException
     */
    public function login(Request $request)
    {

        $token = auth('api')->attempt($request->only(['email', 'password']));
        try{

            if (!$token) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'email' => [
                            "Invalid email or password"
                        ]
                    ]
                ], 422);
            }
        }catch (JWTException $e){
            return response()->json([
                'success' => false,
                'errors' => [
                    'email' => [
                        "Invalid email or password"
                    ]
                ]
            ], 422);
        }

        return response()->json([
            'success'=> true,
            'data'=> $request->user(),
            'token' => $token
    ], 200);
    }
}
