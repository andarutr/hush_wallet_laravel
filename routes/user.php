<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\NabungController;
use App\Http\Controllers\OutcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;

Route::get('/u/dashboard', function () {
    $data['title'] = 'Dashboard';
    return view('pages.dashboard', $data);
});

Route::get('/u/currentSaldo', [WalletController::class, 'currentSaldo']);

Route::prefix('/u/wallet')->group(function(){
    Route::get('/', [WalletController::class, 'index']);
    Route::get('/getData', [WalletController::class, 'getData']);
    Route::post('/store', [WalletController::class, 'store']);
    Route::put('/update', [WalletController::class, 'update']);
    Route::delete('/remove', [WalletController::class, 'remove']);
    Route::get('/transaksi', [WalletController::class, 'transaction']);
    Route::get('/transaksi/getDataAtm', [WalletController::class, 'getDataAtm']);
    Route::get('/transaksi/getDataIncome', [WalletController::class, 'getDataIncome']);
    Route::get('/transaksi/getDataOutcome', [WalletController::class, 'getDataOutcome']);
    Route::get('/transaksi/getDataNabung', [WalletController::class, 'getDataNabung']);
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

Route::prefix('/u/goals')->group(function(){
    Route::get('/', [GoalController::class, 'index']);
    Route::get('/getData', [GoalController::class, 'getData']);
    Route::post('/store', [GoalController::class, 'store']);
    Route::put('/checklist', [GoalController::class, 'checklist']);
    Route::put('/unchecklist', [GoalController::class, 'unchecklist']);
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
