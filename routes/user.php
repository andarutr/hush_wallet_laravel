<?php

use App\Http\Controllers\NabungController;
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

Route::get('/u/income', function () {
    $data['title'] = 'List Income';
    return view('pages.income.list', $data);
});

Route::get('/u/income/laporan', function () {
    $data['title'] = 'Laporan Income';
    return view('pages.income.report', $data);
});

Route::get('/u/outcome', function () {
    $data['title'] = 'List Outcome';
    return view('pages.outcome.list', $data);
});

Route::get('/u/outcome/laporan', function () {
    $data['title'] = 'Laporan Outcome';
    return view('pages.outcome.report', $data);
});