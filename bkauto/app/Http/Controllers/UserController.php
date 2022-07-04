<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','destroy']]);
        $this->id = null;
        if(auth()->user() != null) {
            $this->id = auth()->user()->id;
        }
    }

    public function login (LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if( ! $token =  auth()->attempt($credentials)) {
            return response()->json(['error' => 'unthorized'], 401);
        }

        $user = auth()->user();

        return response()->json($token);
    }

    public function register(RegisterRequest $request) {
       $user =  User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' =>bcrypt( $request->password),
            'created_at' => now(),
            'updated-at' => now()
        ]);

        return $user;

    }

    public function logout(Request $request) {      
        auth('api')->logout();
        return response()->json(["message" => "hello"]);
    }

    public function me() {
        $user =  DB::table('users') 
                 ->where('id','=',$this->id)
                 ->get();

        return response()->json($user);
    }

    public function update(UpdateUserRequest $request) {
       DB::table('users')
           ->where('id','=',$this->id)
           ->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' =>bcrypt( $request->password),
            'updated_at' => now()
           ]);

        $user = DB::table('users')
                ->where('id', '=', $this->id)
                ->get();
        
        return response()->json($user);
    }

}
