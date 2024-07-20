<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OutcomeController extends Controller
{
    public function getDataFirst(Request $req)
    {
        $income = Outcome::where('id', $req->id)->first();
        return response()->json($income);
    }

    public function getDataNominal()
    {
        $start = now()->startOfMonth();  
        $end = now()->endOfMonth(); 

        $outcome = Outcome::where('user_id', auth()->user()->id)
                        ->whereBetween('tgl', [$start, $end])
                        ->sum('nominal');

        $saldo = $outcome ? $outcome : 0;

        return response()->json([
            'saldo' => $saldo
        ]); 
    }

    public function getData(Request $req)
    {
        $outcome = Outcome::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'data' => $outcome
        ]);
    }

    public function getDataReport(Request $req)
    {
        if($req->jenis_filter == 'allData'){
            $outcome = Outcome::where([
                'user_id' => auth()->user()->id
                ])->get(); 
        }else{
            $outcome = Outcome::where([
                'user_id' => auth()->user()->id,
                'tgl' => $req->tanggal_filter,
                'jenis_pengeluaran' => $req->jenis_filter
                ])->get();
        }
        return response()->json([
            'data' => $outcome
        ]);
    }

    public function index()
    {
        $data['title'] = 'List Outcome';
        return view('pages.outcome.list', $data);
    }

    public function report()
    {
        $data['title'] = 'Laporan Outcome';
        return view('pages.outcome.report', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required',
        ], [
            'jenis_pengeluaran.required' => 'Jenis pengeluaran harus diisi!',
            'nominal.required' => 'Nominal outcome harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Outcome::create([
                'user_id' => auth()->user()->id,
                'tgl' => date('Y-m-d'),
                // Andaru Triadi Outcome
                'id_transaksi' => 'ATO'.rand(0, 1000000),
                'jenis_pengeluaran' => $req->jenis_pengeluaran,
                'nominal' => $req->nominal,
                'catatan' => $req->catatan,
            ]);

            return response()->json([
                'message' => 'Berhasil menambahkan data outcome!'
            ]);
        }

    }
    
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required',
        ], [
            'jenis_pengeluaran.required' => 'Jenis pengeluaran harus diisi!',
            'nominal.required' => 'Nominal outcome harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Outcome::where(['user_id' => auth()->user()->id, 'id' => $req->id])->update([
                'tgl' => $req->tgl,
                'jenis_pengeluaran' => $req->jenis_pengeluaran,
                'nominal' => $req->nominal,
                'catatan' => $req->catatan,
            ]);

            return response()->json([
                'message' => 'Berhasil memperbarui data outcome!'
            ]);
        }
    }

    public function remove(Request $req)
    {
        Outcome::where('id', $req->id)->delete();
        return response()->json(['message' => 'Berhasil menghapus outcome!']);
    }
}
