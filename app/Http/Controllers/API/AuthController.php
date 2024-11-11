<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\MemberResource;

class AuthController extends Controller
{
    //register member
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
            'contact_number' => 'required|string',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->save();


        $member = new Member([
            'contact_number' => $request->contact_number,
            'member_id' => 'M' . mt_rand(100000, 999999),
        ]);

        $user->member()->save($member);

        $user->assignRole('member');

        return response()->json([
            'message' => 'Successfully registered',
        ], 201);
    }

    //login member
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details',
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    //logout member
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    //get member details
    public function member()
    {
        return response()->json([
            'member' => new MemberResource(auth()->user()->member),
        ]);
    }
}
