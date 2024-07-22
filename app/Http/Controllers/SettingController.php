<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function getData()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return response()->json($user);
    }

    public function index()
    {
        $data['title'] = 'Setting';
        return view('pages.setting.index', $data);
    }

    public function updateProfile(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama' => 'required',
            'email' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi!',
            'email.required' => 'Email harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            User::where('id', auth()->user()->id)
                    ->update([
                        'nama' => $req->nama,
                        'email' => $req->email,
                        'pekerjaan' => $req->pekerjaan,
                    ]);
            
            return response()->json(['message' => 'Berhasil memperbarui profile']);
        }
    }

    public function updatePassword(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ],[
            'old_password.required' => 'Password lama harus diisi!',
            'new_password.required' => 'Password baru harus diisi!',
            'new_password.min' => 'Password baru harus minimal 6 karakter!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            $check = Auth::attempt(['email' => auth()->user()->email, 'password' => $req->old_password]);

            if($check){
                User::where('id', auth()->user()->id)
                        ->update([
                            'password' => bcrypt($req->new_password)
                        ]);

                return response()->json(['message' => 'Berhasil memperbarui password','status' => 'success']);
            }else{
                return response()->json(['message' => 'Password salah!', 'status' => 'error']);
            }
            
        }
    }
}
