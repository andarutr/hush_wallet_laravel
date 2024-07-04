<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterBankController;

Route::middleware(['auth'])->group(function(){
    Route::get('/su/dashboard', function () {
        $data['title'] = 'Dashboard';
        return view('pages.admin.dashboard', $data);
    });

    Route::get('/su/master/bank', [MasterBankController::class, 'index']);
    Route::get('/su/master/bank/getData', [MasterBankController::class, 'getData']);
    Route::post('/su/master/bank/store', [MasterBankController::class, 'store']);
    Route::delete('/su/master/bank/remove', [MasterBankController::class, 'remove']);
    Route::delete('/su/master/bank/removeChoose', [MasterBankController::class, 'removeChoose']);
});
