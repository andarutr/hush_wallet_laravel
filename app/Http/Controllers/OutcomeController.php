<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Outcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $outcome = Outcome::where('user_id', auth()->user()->id)
                            ->limit(10)->get();
                            
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
        $data['wallets'] = Wallet::where('user_id', auth()->user()->id)->get();
        
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
            'wallet_id' => 'required',
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required',
        ], [
            'wallet_id.required' => 'Pilih wallet dulu!',
            'jenis_pengeluaran.required' => 'Jenis pengeluaran harus diisi!',
            'nominal.required' => 'Nominal outcome harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            $walletId = Wallet::where('id', $req->wallet_id)->first();

            if($walletId->saldo < $req->nominal){
                return response()->json([
                    'title' => 'Upssss',
                    'icon' => 'error',
                    'message' => 'Saldo wallet Tidak Cukup!',
                    'status' => 'failed'
                ]);    
            }else{
                Outcome::create([
                    'wallet_id' => $req->wallet_id,
                    'user_id' => auth()->user()->id,
                    'tgl' => date('Y-m-d'),
                    // Andaru Triadi Outcome
                    'id_transaksi' => 'ATO'.rand(0, 1000000),
                    'jenis_pengeluaran' => $req->jenis_pengeluaran,
                    'nominal' => $req->nominal,
                    'catatan' => $req->catatan,
                ]);
    
                Wallet::where('id', $req->wallet_id)
                        ->update([
                            'saldo' => DB::raw('saldo - '.$req->nominal)
                        ]);
    
                return response()->json([
                    'title' => 'Berhasil',
                    'icon' => 'success',
                    'message' => 'Berhasil menambahkan data outcome!',
                    'status' => 'success'
                ]);
            }
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
            $outcome = Outcome::where('id', $req->id)->first();

            if($outcome->nominal > $req->nominal){
                // Jalankan jika nominal sebelumnya lebih besar 
                // dari nominal ter-update
                $jumlah = $outcome->nominal - $req->nominal;

                Wallet::where('id', $req->wallet_id)
                ->update([
                    'saldo' => DB::raw('saldo - '.$jumlah) 
                ]);
            }elseif($outcome->nominal < $req->nominal){
                // Jalankan jika nominal sebelumnya lebih kecil 
                // dari nominal ter-update
                $jumlah = $req->nominal - $outcome->nominal;

                Wallet::where('id', $req->wallet_id)
                ->update([
                    'saldo' => DB::raw('saldo + '.$jumlah) 
                ]);
            }

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
        $wallet_id = Outcome::where('id', $req->id)->first();
        Wallet::where('id', $wallet_id->wallet_id)
                ->update([
                    'saldo' => DB::raw('saldo + '.$req->nominal)
                ]);
        
        Outcome::where('id', $req->id)->delete();
        

        return response()->json(['message' => 'Berhasil menghapus outcome!']);
    }
}
