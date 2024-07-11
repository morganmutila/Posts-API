<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $request->validated();

        $user = User::where("email", $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){

            return response()->json([
                "message"=> "The provided credentials are incorrect",
            ], 401);
        }

        $device = $request->userAgent();
        $token = $user->createToken($device)->plainTextToken;

        return response()->json([
            "access_token" => $token,
        ]);
    }
}
