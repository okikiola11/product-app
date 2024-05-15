<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'confirmPassword' => 'required',
            'name' => 'required',

        ])->validate();

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            //'role' => "0",
        ]);

        return response()->json([
            'status' => 201,
            //'redirect_url' => route('students.index'),
            'message' => "User created successfully",
            'user' => $user,
        ]);
        // if($user) {
            //return redirect()->route('login');
        // }
    }
}
