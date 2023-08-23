<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a Register Method.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required'
        ], [
            'name.required'     => 'Nama Wajib Diisi !',
            'email.required'    => 'Email Wajib Diisi !',
            'email.unique'      => 'Email Sudah Terdaftar',
            'password.required' => 'Password Wajib Diisi !'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->input('password'))
        ]);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Register Succesfully !',
            'data'      => $user 
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ], [
            'email.required'    => 'Email Wajib Diisi !',
            'password.required' => 'Password Wajib Diisi !'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $user   = Auth::user();
            $token  = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status'    => true,
                'message'   => 'Login Succesfully',
                'user'      => $user,
                'token'     => $token
            ]);
        }

        return response()->json([
            'status'    => false,
            'message'   => 'Gagal ! Periksa email dan kata sandi',
        ], 401);
    }

}
