<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTFactory;
use JWTAuth;
use Validator;


class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api',['except'=>['login','register']]);
    }
    function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        $token=JWtAuth::fromUser($user);
return response()->json(compact('token'),201);
    }





    function login(Request $request){
        $validator=Validator::make($request->all(),[
           
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }

        try{
            $credentials=$request->only('email','password');
            if(!$token=JWTAuth::attempt($credentials)){
                return response()->json('unathurized');
            }

            $user=User::where('email',$request->email)->first();

            return response()->json(compact(['token','user']));


        }
        catch(\JWTException $e){
            return response()->json('error',401);
        }
    }
}
