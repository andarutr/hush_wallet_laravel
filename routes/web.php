<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    $data['title'] = 'Login';
    return view('pages.auth.login', $data);
});

Route::get('/register', function () {
    $data['title'] = 'Register';
    return view('pages.auth.register', $data);
});

Route::get('/u/dashboard', function () {
    $data['title'] = 'Dashboard';
    return view('pages.dashboard', $data);
});

Route::get('/u/wallet', function () {
    $data['title'] = 'Wallet';
    return view('pages.wallet.list', $data);
});
