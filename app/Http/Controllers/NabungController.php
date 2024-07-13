<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use App\Models\MasterPlatform;
use Illuminate\Support\Facades\Validator;

class NabungController extends Controller
{
    public function getData()
    {
        $saving = Saving::where('user_id', auth()->user()->id)
                        ->join('master_platform','savings.platform','=','master_platform.nama_platform')
                        ->select('savings.*', 'master_platform.nama_platform','master_platform.picture')
                        ->orderByDesc('created_at')
                        ->limit(5)->get();

        return response()->json($saving);
    }

    public function index()
    {
        $data['title'] = 'Nabung';
        $data['nabung'] = MasterPlatform::all();

        return view('pages.nabung.list', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'jenis_tabungan' => 'required',
            'platform' => 'required',
            'nominal' => 'required',
        ],[
            'jenis_tabungan.required' => 'Jenis tabungan harus diisi!',
            'platform.required' => 'Platform harus diisi!',
            'nominal.required' => 'Nominal harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Saving::create([
                'user_id' => auth()->user()->id,
                // Andaru Triadi Savings
                'id_transaksi' => "ATS".rand(0, 1000000),
                'jenis_tabungan' => $req->jenis_tabungan,
                'platform' => $req->platform,
                'nominal' => $req->nominal,
                'catatan' => $req->catatan,
            ]);

            return response()->json([
                'message' => 'Berhasil menambahkan data tabungan!'
            ]);
        }
    }
}
