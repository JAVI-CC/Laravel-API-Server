<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(Request $request) {
        $validator = $this->user->validation_register($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 220);
        } else {
            $user = $this->user->add_register($request);
            return response()->json($user, 201);
        }
    }

    public function login(Request $request) {
        $validator = $this->user->validation_login($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 220);
        } else {
            $user = $this->user->login($request);
            return response()->json($user, 201);
        }
    }

    public function logout() {
        return $this->user->logout();
    }

    public function userinfo() {
       return auth()->user();
    }

}
