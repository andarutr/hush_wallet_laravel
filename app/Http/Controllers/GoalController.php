<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GoalController extends Controller
{
    public function getData()
    {
        $goals = Goal::where('user_id', auth()->user()->id)->get();

        return response()->json($goals);
    }

    public function index()
    {
        $data['title'] = 'Goals';
        return view('pages.goal.list', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'judul' => 'required',
            'catatan' => 'required',
        ],[
            'judul.required' => 'Judul harus diisi!',
            'catatan.required' => 'Catatan harus diisi!'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Goal::create([
                'user_id' => auth()->user()->id,
                'judul' => $req->judul,
                'catatan' => $req->catatan
            ]);

            return response()->json([
                'message' => 'Berhasil menambahkan goals!'
            ]);
        }
    }

    public function checklist(Request $req)
    {
        Goal::where('id', $req->id)
                ->update([
                    'is_checked' => 1
                ]);
    }

    public function unchecklist(Request $req)
    {
        Goal::where('id', $req->id)
                ->update([
                    'is_checked' => 0
                ]);
    }

    public function remove(Request $req)
    {
        Goal::where('id', $req->id)->delete();

        return response()->json([
            'message' => 'Berhasil menghapus goal!'
        ]);
    }
}
