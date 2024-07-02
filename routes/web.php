<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginBackend']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerBackend']);

Route::get('/u/dashboard', function () {
    $data['title'] = 'Dashboard';
    return view('pages.dashboard', $data);
});

Route::get('/u/wallet', function () {
    $data['title'] = 'Wallet';
    return view('pages.wallet.list', $data);
});

Route::get('/u/wallet/transaksi-in/{id_transaction}', function () {
    $data['title'] = 'Wallet Transaksi IN';
    return view('pages.wallet.transaction_in', $data);
});

Route::get('/u/wallet/transaksi-out/{id_transaction}', function () {
    $data['title'] = 'Wallet Transaksi OUT';
    return view('pages.wallet.transaction_out', $data);
});

Route::get('/u/nabung', function () {
    $data['title'] = 'Nabung';
    return view('pages.nabung.list', $data);
});

Route::get('/u/nabung/selengkapnya', function () {
    $data['title'] = 'Detail Nabung';
    return view('pages.nabung.all', $data);
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