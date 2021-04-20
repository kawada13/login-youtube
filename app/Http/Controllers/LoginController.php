<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'ログイン成功'], 200);
        }

        return response()->json(['message' => 'emailまたはpasswordが間違っています。'], 200);
 
    }
 
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'ログイン失敗'], 200);
    }
}
