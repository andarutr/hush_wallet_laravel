<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\MasterBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function getData()
    {
        $wallet = Wallet::where('user_id', auth()->user()->id)
                        ->join('master_bank','wallets.bank','=','master_bank.nama_bank')
                        ->select('wallets.*','master_bank.picture')
                        ->get();

        return response()->json($wallet);
    }

    public function index()
    {
        $data['title'] = 'Wallet';
        $data['rekening'] = MasterBank::all();
        
        return view('pages.wallet.list', $data);
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'bank' => 'required',
            'rekening' => 'required|unique:wallets',
            'saldo' => 'required',
        ],[
            'bank.required' => 'Nama bank harus diisi!',
            'rekening.unique' => 'Rekening sudah ada sebelumnya!',
            'rekening.required' => 'Nama bank harus diisi!',
            'saldo.required' => 'Nama bank harus diisi!'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Wallet::create([
                'user_id' => auth()->user()->id,
                'bank' => $req->bank,
                'rekening' => $req->rekening,
                'saldo' => $req->saldo
            ]);

            return response()->json([
                'message' => 'Berhasil menambah data wallet!'
            ]);
        }
    }

    public function update(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'bank' => 'required',
            'rekening' => 'required',
            'saldo' => 'required',
        ],[
            'bank.required' => 'Nama bank harus diisi!',
            'rekening.required' => 'Nama bank harus diisi!',
            'saldo.required' => 'Nama bank harus diisi!'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            Wallet::where('id', $req->id)->update([
                'bank' => $req->bank,
                'rekening' => $req->rekening,
                'saldo' => $req->saldo
            ]);

            return response()->json([
                'message' => 'Berhasil memperbarui data wallet!'
            ]);
        }
    }

    public function remove(Request $req)
    {
        Wallet::where('id', $req->id)->delete();

        return response()->json([
            'message' => 'Berhasil menghapus data'
        ]);
    }
}
