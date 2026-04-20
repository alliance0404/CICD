<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $user = $request->user(); // authenticated user
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
        ]);
    }
    public function admin(Request $request)
    {
        $user = $request->user(); // authenticated user
        return response()->json([
            "message" => "admin area",
            "user" => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],

        ]);
    }

    public function managerOrAdmin(Request $request)
    {
        $user = $request->user(); // authenticated user

        return response()->json([
            "message" => "manager or admin area",
            "user" => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],

        ]);
    }

    function fakeSamlLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $token = $user->createToken('apiToken')->plainTextToken;

        return response()->json(['status' => 'ok', 'token' => $token], 200);
    }
}
