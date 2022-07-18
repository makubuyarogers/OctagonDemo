<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{

    public function users()
    {
        //Fetching all users
        try {
            $users = User::all()->toJson(JSON_PRETTY_PRINT);
            return response($users, 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ],500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user=User::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone_number'=>$request->phone_number,
                'password'=> Hash::make($request->password)
            ]);
            $user->createToken('authToken')->accessToken;
            return response()->json([
                'status'=>true,
                'message'=>'User created sucessfully',
                'user'=>$user,
                'token'=>$user->createToken('authToken')->accessToken
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ],500);
        }
    }

    public function login(Request $request){
        //Request validation
        try {
            $login_request=$request->validate([
                'phone_number'=>'required|string',
                'password'=>'required|string'
            ]);
            if(!Auth::attempt($login_request)){
                return response(['message'=>'Ivalid Login Credentials']);
            }
            $_token = Auth::user()->createToken('authToken')->accessToken;
            return response(['user'=>Auth::user(),'access_token'=>$_token]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ],500);
        }
    }

    public function show($id)
    {   
        //Getting user if user exists
        try{
        if (User::find($id)->exists()) {
            $user = User::find($id)->toJson(JSON_PRETTY_PRINT);
            return response($user, 200);
        } 
        else {
            return response()->json([
              "message" => "User not found"
            ], 404);
        }
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>$th->getMessage()
            ],500);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
