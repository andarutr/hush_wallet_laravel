<?php

namespace App\Http\Controllers;

use App\Models\MasterBank;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $data['title'] = 'Wallet';
        $data['rekening'] = MasterBank::all();
        
        return view('pages.wallet.list', $data);
    }
}
