<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{

    //Getting all registered Users
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

    //Function for registering User
    public function store(Request $request)
    {
        try {
            
            //Adding User to database
            $user=User::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'phone_number'=>$request->phone_number,
                'password'=> Hash::make($request->password)
            ]);
            //Generating User Access token
            $user->createToken('authToken')->accessToken;
            //Returning http response 
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
        
        try {
            //Request validation for login form
            $login_request=$request->validate([
                'phone_number'=>'required|string',
                'password'=>'required|string'
            ]);
            //Checking if User exists in database
            if(!Auth::attempt($login_request)){
                return response(['message'=>'Ivalid Login Credentials']);
            }
            //Otherwise if the user exists, a token is generated
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
            //Returning User
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
