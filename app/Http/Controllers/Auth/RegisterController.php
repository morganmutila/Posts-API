<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);


        $device = $request->userAgent();

        $token = $user->createToken($device)->plainTextToken;

        return response()->json([
            "user" => $user,
            "access_token" => $token,
        ]);

    }
}
