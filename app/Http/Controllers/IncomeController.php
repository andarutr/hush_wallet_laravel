<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $income = Income::where('user_id', auth()->user()->id)
                        ->limit(10)->get();

        return response()->json([
            'data' => $income
        ]);
    }

    public function getDataReport(Request $req)
    {
        if($req->jenis_filter == 'allData'){
            $income = Income::where([
                'user_id' => auth()->user()->id
                ])->get(); 
        }else{
            $income = Income::where([
                'user_id' => auth()->user()->id,
                'tgl_income' => $req->tanggal_filter,
                'jenis_pendapatan' => $req->jenis_filter
                ])->get();
        }
        return response()->json([
            'data' => $income
        ]);
    }

    public function index()
    {
        $data['title'] = 'List Income';
        $data['wallets'] = Wallet::where('user_id', auth()->user()->id)->get();

        return view('pages.income.list', $data);
    }

    public function report()
    {
        $data['title'] = 'Laporan Income';
        return view('pages.income.report', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'wallet_id' => 'required',
            'jenis_pendapatan' => 'required',
            'nominal' => 'required',
            'tgl_income' => 'required',
        ], [
            'wallet_id.required' => 'Pilih wallet dulu!',
            'jenis_pendapatan.required' => 'Jenis pendapatan harus diisi!',
            'nominal.required' => 'Nominal income harus diisi!',
            'tgl_income.required' => 'Tanggal harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Income::create([
                'wallet_id' => $req->wallet_id,
                'user_id' => auth()->user()->id,
                'tgl_income' => $req->tgl_income,
                // Andaru Triadi Income
                'id_transaksi' => 'ATI'.rand(0, 1000000),
                'jenis_pendapatan' => $req->jenis_pendapatan,
                'nominal' => $req->nominal,
                'catatan' => $req->catatan,
            ]);

            Wallet::where('id', $req->wallet_id)
                    ->update([
                        'saldo' => DB::raw('saldo + '.$req->nominal)
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
            $income = Income::where('id', $req->id)->first();

            if($income->nominal > $req->nominal){
                // Jalankan jika nominal sebelumnya lebih besar 
                // dari nominal ter-update
                $jumlah = $income->nominal - $req->nominal;

                Wallet::where('id', $req->wallet_id)
                ->update([
                    'saldo' => DB::raw('saldo - '.$jumlah) 
                ]);
            }elseif($income->nominal < $req->nominal){
                // Jalankan jika nominal sebelumnya lebih kecil 
                // dari nominal ter-update
                $jumlah = $req->nominal - $income->nominal;

                Wallet::where('id', $req->wallet_id)
                ->update([
                    'saldo' => DB::raw('saldo + '.$jumlah) 
                ]);
            }

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
        $wallet_id = Income::where('id', $req->id)->first();
        Wallet::where('id', $wallet_id->wallet_id)
                ->update([
                    'saldo' => DB::raw('saldo - '.$req->nominal)
                ]);

        Income::where('id', $req->id)->delete();

        return response()->json(['message' => 'Berhasil menghapus income!']);
    }
}
