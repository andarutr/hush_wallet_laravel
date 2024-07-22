<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Saving;
use App\Models\Wallet;
use App\Models\Outcome;
use App\Models\MasterBank;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function currentSaldo(Request $req)
    {
        $currentSaldo = Wallet::where([
            'id' => $req->id,
            'user_id' => auth()->user()->id
        ])->first();

        return response()->json($currentSaldo);
    }

    public function getData()
    {
        $wallet = Wallet::where('user_id', auth()->user()->id)
                        ->join('master_bank','wallets.bank','=','master_bank.nama_bank')
                        ->select('wallets.*','master_bank.picture')
                        ->get();

        return response()->json($wallet);
    }
    
    public function getDataAtm(Request $req)
    {
        $wallet = Wallet::where([
                            'wallets.id' => $req->id,
                            'wallets.user_id' => auth()->user()->id
                        ])
                        ->join('master_bank','wallets.bank','=','master_bank.nama_bank')
                        ->select('wallets.*','master_bank.picture')
                        ->first();

        return response()->json($wallet);
    }

    public function getDataIncome()
    {
        $income = Income::where([
                        'user_id' => auth()->user()->id
                        ])->get();

        return response()->json([
            'data' => $income
        ]);
    }
    
    public function getDataNabung()
    {
        $nabung = Saving::where([
            'user_id' => auth()->user()->id
            ])->get();

        return response()->json([
            'data' => $nabung
        ]);
    }

    public function getDataOutcome()
    {
        $outcome = Outcome::where([
                        'user_id' => auth()->user()->id
                        ])->get();

        return response()->json([
            'data' => $outcome
        ]);
    }

    public function index()
    {
        $data['title'] = 'Wallet';
        $data['rekening'] = MasterBank::all();
        
        return view('pages.wallet.list', $data);
    }

    public function transaction()
    {
        $data['title'] = 'Wallet Semua Transaksi';
        $data['platform'] = Saving::where('user_id', auth()->user()->id)
                                    ->groupBy('platform')
                                    ->pluck('platform');

        return view('pages.wallet.transaksi', $data);
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

    public function downloadRekapanIncome(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'from' => 'required',
            'to' => 'required',
        ],[
            'from.required' => 'From input harus diisi!',
            'to.required' => 'To input harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            $data['income'] = Income::whereBetween('tgl_income', [$req->from, $req->to])
                                        ->where('user_id', auth()->user()->id)->get();
            $data['total'] = Income::whereBetween('tgl_income', [$req->from, $req->to])
                                        ->where('user_id', auth()->user()->id)->sum('nominal');
            $data['bank'] = MasterBank::where('id', $req->bankId)->first();
            $data['dari'] = $req->from;
            $data['ke'] = $req->to;

            $pdf = Pdf::loadView('pages.wallet.export_income_pdf', $data);
            return $pdf->download('Export Income '.$req->from.' - '.$req->to.'.pdf');
        }
    }
    
    public function downloadRekapanOutcome(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'from' => 'required',
            'to' => 'required',
        ],[
            'from.required' => 'From input harus diisi!',
            'to.required' => 'To input harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            $data['outcome'] = Outcome::whereBetween('tgl', [$req->from, $req->to])
                                        ->where('user_id', auth()->user()->id)->get();
            $data['total'] = Outcome::whereBetween('tgl', [$req->from, $req->to])
                                        ->where('user_id', auth()->user()->id)->sum('nominal');
            $data['bank'] = MasterBank::where('id', $req->bankId)->first();
            $data['dari'] = $req->from;
            $data['ke'] = $req->to;

            $pdf = Pdf::loadView('pages.wallet.export_outcome_pdf', $data);
            return $pdf->download('Export Outcome '.$req->from.' - '.$req->to.'.pdf');
        }
    }

    public function downloadRekapanNabung(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'from' => 'required',
            'to' => 'required',
            'platform' => 'required',
        ],[
            'from.required' => 'From input harus diisi!',
            'to.required' => 'To input harus diisi!',
            'platform.required' => 'Platform input harus diisi!',
        ]);

        if($validator->fails()){
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }else{
            if($req->platform == 'allPlatform'){
                $data['nabung'] = Saving::whereBetween('created_at', [$req->from, $req->to])
                                        ->where('user_id', auth()->user()->id)->get();
                $data['total'] = Saving::whereBetween('created_at', [$req->from, $req->to])
                                        ->where('user_id', auth()->user()->id)->sum('nominal');
            }else{
                $data['nabung'] = Saving::whereBetween('created_at', [$req->from, $req->to])
                                    ->where('platform', $req->platform)
                                    ->where('user_id', auth()->user()->id)->get();
                $data['total'] = Saving::whereBetween('created_at', [$req->from, $req->to])
                                    ->where('platform', $req->platform)
                                    ->where('user_id', auth()->user()->id)
                                    ->sum('nominal');
            }

            $data['dari'] = $req->from;
            $data['ke'] = $req->to;
            $data['platform'] = $req->platform;
            
            $pdf = Pdf::loadView('pages.wallet.export_nabung_pdf', $data);
            return $pdf->download('Export Tabungan '.$req->platform.' '.$req->from.' - '.$req->to.'.pdf');
        }
    }
}
