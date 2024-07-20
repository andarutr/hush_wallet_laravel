<?php

use App\Http\Controllers\IncomeController;
use App\Http\Controllers\NabungController;
use App\Http\Controllers\OutcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;

Route::get('/u/dashboard', function () {
    $data['title'] = 'Dashboard';
    return view('pages.dashboard', $data);
});

Route::get('/u/wallet', [WalletController::class, 'index']);
Route::get('/u/wallet/getData', [WalletController::class, 'getData']);
Route::post('/u/wallet/store', [WalletController::class, 'store']);
Route::put('/u/wallet/update', [WalletController::class, 'update']);
Route::delete('/u/wallet/remove', [WalletController::class, 'remove']);

Route::get('/u/wallet/transaksi-in/{id_transaction}', function () {
    $data['title'] = 'Wallet Transaksi IN';
    return view('pages.wallet.transaction_in', $data);
});

Route::get('/u/wallet/transaksi-out/{id_transaction}', function () {
    $data['title'] = 'Wallet Transaksi OUT';
    return view('pages.wallet.transaction_out', $data);
});

Route::prefix('/u/nabung')->group(function(){
    Route::get('/', [NabungController::class, 'index']);
    Route::get('/getData', [NabungController::class, 'getData']);
    Route::post('/store', [NabungController::class, 'store']);
    
    Route::get('/transaksi', [NabungController::class, 'list_transaksi']);
    Route::get('/transaksi/getData', [NabungController::class, 'getDataTransaksi']);
    Route::get('/transaksi/getDataFirst', [NabungController::class, 'getDataTransaksiFirst']);
    Route::put('/transaksi/update', [NabungController::class, 'update']);
    Route::delete('/transaksi/remove', [NabungController::class, 'remove']);
    Route::delete('/transaksi/removeChoose', [NabungController::class, 'removeChoose']);
});

Route::get('/u/goals', function () {
    $data['title'] = 'Goals';
    return view('pages.goal.list', $data);
});

Route::prefix('/u/income')->group(function(){
    Route::get('/', [IncomeController::class, 'index']);
    Route::get('/getData', [IncomeController::class, 'getData']);
    Route::get('/getDataSaldo', [IncomeController::class, 'getDataSaldo']);
    Route::get('/getDataFirst', [IncomeController::class, 'getDataFirst']);
    Route::post('/store', [IncomeController::class, 'store']);
    Route::put('/update', [IncomeController::class, 'update']);
    Route::delete('/remove', [IncomeController::class, 'remove']);
    Route::get('/laporan', [IncomeController::class, 'report']);
    Route::get('/laporan/getData', [IncomeController::class, 'getDataReport']);
});

Route::prefix('/u/outcome')->group(function(){
    Route::get('/', [OutcomeController::class, 'index']);
    Route::get('/getData', [OutcomeController::class, 'getData']);
    Route::get('/getDataNominal', [OutcomeController::class, 'getDataNominal']);
    Route::get('/getDataFirst', [OutcomeController::class, 'getDataFirst']);
    Route::post('/store', [OutcomeController::class, 'store']);
    Route::put('/update', [OutcomeController::class, 'update']);
    Route::delete('/remove', [OutcomeController::class, 'remove']);
    Route::get('/laporan', [OutcomeController::class, 'report']);
    Route::get('/laporan/getData', [OutcomeController::class, 'getDataReport']);
});
