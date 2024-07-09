<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterBankController;
use App\Http\Controllers\MasterPlatformController;

Route::middleware(['auth'])->group(function(){
    Route::get('/su/dashboard', function () {
        $data['title'] = 'Dashboard';
        return view('pages.admin.dashboard', $data);
    });

    // Master Data
    Route::prefix('/su/master')->group(function(){
        // Bank
        Route::prefix('/bank')->group(function(){
            Route::get('/', [MasterBankController::class, 'index']);
            Route::get('/getData', [MasterBankController::class, 'getData']);
            Route::post('/store', [MasterBankController::class, 'store']);
            Route::delete('/remove', [MasterBankController::class, 'remove']);
            Route::delete('/removeChoose', [MasterBankController::class, 'removeChoose']);
        });
        // Platform
        Route::prefix('/platform')->group(function(){
            Route::get('/', [MasterPlatformController::class, 'index']);
            Route::get('/getData', [MasterPlatformController::class, 'getData']);
            Route::post('/store', [MasterPlatformController::class, 'store']);
            Route::delete('/remove', [MasterPlatformController::class, 'remove']);
            Route::delete('/removeChoose', [MasterPlatformController::class, 'removeChoose']);
        });
    });
});
