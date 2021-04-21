<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authUser(Request $request)
    {

        // return $request->user();

        // try {
        //     $user = Auth::user();

        //     return response()->json([
        //         'user' => $user,
        //         'message' => '成功'
        //     ],200);
        // }
        // catch(\Exception $e) {
        //     return response()->json([
        //         'message' => '取得できませんでした。',
        //     ],500,[],
        //     JSON_UNESCAPED_UNICODE);
        // }

        $user = Auth::user();

        if($user) {
            return response()->json([
                'user' => $user,
                'message' => '成功'
            ],200);
        } else {
            return response()->json([
                'message' => '取得できませんでした。',
            ],500,[],
            JSON_UNESCAPED_UNICODE);
        }
    }
}
