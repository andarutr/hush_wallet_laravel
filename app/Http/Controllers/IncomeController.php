<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    public function getDataSaldo()
    {
        $start = now()->startOfMonth();  
        $end = now()->endOfMonth(); 

        $income = Income::where('user_id', auth()->user()->id)
                        ->whereBetween('tgl_income', [$start, $end])
                        ->sum('nominal');

        $saldo = $income ? $income : 0;

        return response()->json([
            'saldo' => $saldo
        ]); 
    }

    public function getDataFirst(Request $req)
    {
        $income = Income::where('id', $req->id)->first();
        return response()->json($income);
    }

    public function getData(Request $req)
    {
        $income = Income::where('user_id', auth()->user()->id)->get();
        return response()->json([
            'data' => $income
        ]);
    }

    public function index()
    {
        $data['title'] = 'List Income';
        return view('pages.income.list', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'jenis_pendapatan' => 'required',
            'nominal' => 'required',
        ], [
            'jenis_pendapatan.required' => 'Jenis pendapatan harus diisi!',
            'nominal.required' => 'Nominal income harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Income::create([
                'user_id' => auth()->user()->id,
                'tgl_income' => date('Y-m-d'),
                // Andaru Triadi Income
                'id_transaksi' => 'ATI'.rand(0, 1000000),
                'jenis_pendapatan' => $req->jenis_pendapatan,
                'nominal' => $req->nominal,
                'catatan' => $req->catatan,
            ]);

            return response()->json([
                'message' => 'Berhasil menambahkan data income!'
            ]);
        }

    }
    
    public function update(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'jenis_pendapatan' => 'required',
            'nominal' => 'required',
        ], [
            'jenis_pendapatan.required' => 'Jenis pendapatan harus diisi!',
            'nominal.required' => 'Nominal income harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Income::where(['user_id' => auth()->user()->id, 'id' => $req->id])->update([
                'tgl_income' => $req->tgl_income,
                'jenis_pendapatan' => $req->jenis_pendapatan,
                'nominal' => $req->nominal,
                'catatan' => $req->catatan,
            ]);

            return response()->json([
                'message' => 'Berhasil memperbarui data income!'
            ]);
        }
    }

    public function remove(Request $req)
    {
        Income::where('id', $req->id)->delete();
        return response()->json(['message' => 'Berhasil menghapus income!']);
    }
}
