<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            return response()->json(['message' => 'ログイン成功'], 200);
        }

        return response()->json(['message' => 'emailまたはpasswordが間違っています。'], 500);
 
    }
 
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'ログイン失敗'], 500);
    }

    public function register(LoginRequest $request)
    {

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,

                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            DB::commit();

            return response()->json([
                'message' => '成功'
            ],200);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => '失敗'
            ],500);
        }
    }

}
