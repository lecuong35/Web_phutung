<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
        // // $this->id =  auth()->guard('admin')->user()->id;
        if(auth()->guard('admin')->user() != null) {
            $this->id = auth()->guard('admin')->user()->id;
        }
    }

    public function login (LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if( ! $token =  auth()->guard('admin')->attempt($credentials)) {
            return response()->json([$request->messages()], 401);
        }

        return response()->json($token);
    }

    public function register(Request $request) {
       $admin =  Admin::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'password' =>bcrypt( $request->password),
            'bank' => $request->bank,
            'facebook' => $request->facebook,
            'created_at' => now(),
            'updated-at' => now()
        ]);

        return $admin;

    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'logout']);
    }

    public function me() {
        $admin =  DB::table('admins') 
                 ->where('id','=',$this->id)
                 ->get();

        return response()->json([$admin]);
    }

    public function update(UpdateAdminRequest $request) {
       DB::table('admins')
           ->where('id','=',$this->id)
           ->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'bank' => $request->bank,
            'facebook' => $request->facebook,
            'password' =>bcrypt( $request->password),
            'updated_at' => now()
           ]);

        $admin = DB::table('admins')
                ->where('id','=',$this->id)
                ->get();
        return response()->json($admin);
    }

    //destroy user
    public function destroy_user($id)
    {
        DB::table('users')
        ->where('id', '=', $id)
        ->delete();

        return response()->json(['message' => 'deleted']);
    }

}
