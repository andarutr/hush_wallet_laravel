<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        $data['title'] = 'Login';
        return view('pages.auth.login', $data);
    }

    public function loginBackend(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email harus diisi!',
            'password.required' => 'Password harus diisi!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }else{
            $auth = Auth::attempt(['email' => $req->email, 'password' => $req->password]);

            if($auth){
                $is_admin = Auth::user()->is_admin;

                return response()->json([
                    'status' => 'success',
                    'is_admin' => $is_admin
                ]);
            }else{
                return response()->json([
                    'status' => 'error'
                ]);
            }
        }
    }

    public function register()
    {
        $data['title'] = 'Register';
        return view('pages.auth.register', $data);
    }
    
    public function registerBackend(Request $req)
    {
        $validators = Validator::make($req->all(), [
            'nama' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
        ],[
            'nama.required' => 'Nama harus diisi!',
            'email.required' => 'Email harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        if($validators->fails()){
            return response()->json([
                'status' => 'error',
                'errors' => $validators->errors(),
            ], 422);
        }else{
            $user = new User();
            $user->nama = $req->nama;
            $user->email = $req->email;
            $user->password = \Hash::make($req->password);
            $user->is_admin = 'n';
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil membuat akun!'
            ]);
        }
    }

    public function logoutBackend()
    {
        Auth::logout();
        
        return response()->json([
            'message' => 'Berhasil logout!'
        ]);
    }
}
