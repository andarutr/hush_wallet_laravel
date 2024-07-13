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

    public function getDataTransaksi()
    {
        $transaksi = Saving::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'data' => $transaksi
        ]);
    }
   
    public function getDataTransaksiFirst(Request $req)
    {
        $transaksi = Saving::where([
            'user_id' => auth()->user()->id,
            'id' => $req->id
        ])->first();

        return response()->json($transaksi);
    }

    public function index()
    {
        $data['title'] = 'Nabung';
        $data['nabung'] = MasterPlatform::all();

        return view('pages.nabung.list', $data);
    }

    function list_transaksi(){
        $data['title'] = 'Transaksi Tabungan';
        $data['nabung'] = MasterPlatform::all();

        return view('pages.nabung.transaksi', $data);
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
    
    public function update(Request $req)
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
            Saving::where(['user_id' => auth()->user()->id, 'id' => $req->id])
                        ->update([
                            'created_at' => $req->created_at,
                            'jenis_tabungan' => $req->jenis_tabungan,
                            'platform' => $req->platform,
                            'nominal' => $req->nominal,
                            'catatan' => $req->catatan,
                        ]);

            return response()->json([
                'message' => 'Berhasil memperbarui data tabungan!'
            ]);
        }
    }

    public function remove(Request $req)
    {
        Saving::where('id', $req->id)->delete();
        return response()->json(['message' => 'Berhasil menghapus transaksi!']);
    }

    public function removeChoose(Request $req)
    {
        $data = $req->input('data');
	
        if(!empty($data)){
            foreach ($data as $item) {
                if($item['checkwishId'] !== 'on'){
                    Saving::where('id', $item['checkwishId'])->delete();
                }
            }

            return response()->json(['success' => true, 'message' => 'Data berhasil dikirim.']);
        }else {
            return response()->json(['success' => false, 'message' => 'Tidak ada data yang dikirim.']);
        }
    }
}
