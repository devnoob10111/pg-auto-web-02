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

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    // return redirect()->route('home');
    // return what you want
});

Route::get('/optimize-clear', function () {
    $exitCode = Artisan::call('optimize:clear');
});

Route::get('/404', function () {
    return view('page404');
})->name('page404');


Route::group(['middleware' => ['load.prefix']],function () {
    Route::get('/bank/list', [App\Http\Controllers\AuthController::class, 'getBankList'])->name('getBankList');
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register')->middleware('guest');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login')->middleware('guest');

    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth-login');
    Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('auth-logout');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'pageWallet']);
    Route::get('/wallet', [App\Http\Controllers\HomeController::class, 'pageWallet'])->name('wallet');
    Route::get('/deposit', [App\Http\Controllers\HomeController::class, 'pageDeposit'])->name('deposit');
    Route::get('/deposit/bank', [App\Http\Controllers\HomeController::class, 'pageDepositBank'])->name('deposit-bank');
    Route::get('/deposit/wallet', [App\Http\Controllers\HomeController::class, 'pageDepositWallet'])->name('deposit-wallet');
    Route::get('/withdraw', [App\Http\Controllers\HomeController::class, 'pageWithdraw'])->name('withdraw');
    Route::post('/withdraw', [App\Http\Controllers\HomeController::class, 'withdraw'])->name('transfer-withdraw');
    Route::get('/promotion', [App\Http\Controllers\HomeController::class, 'pagePromotion'])->name('promotion');
    Route::get('/transactions/deposit', [App\Http\Controllers\HomeController::class, 'pageTransactionsDeposit'])->name('transactions-deposit');
    Route::get('/transactions/withdraw', [App\Http\Controllers\HomeController::class, 'pageTransactionsWithdraw'])->name('transactions-withdraw');
    Route::get('/transactions/other', [App\Http\Controllers\HomeController::class, 'pageTransactionsOther'])->name('transactions-other');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'pageProfile'])->name('profile');
    Route::get('/affiliate', [App\Http\Controllers\HomeController::class, 'pageAffiliate'])->name('affiliate');
    Route::get('/lucky-wheel', [App\Http\Controllers\HomeController::class, 'pageLuckyWheel'])->name('lucky-wheel');
    Route::get('/ranking', [App\Http\Controllers\HomeController::class, 'pageRanking'])->name('ranking');
    Route::get('/account', [App\Http\Controllers\HomeController::class, 'pageAccount'])->name('account');
    Route::get('/game', [App\Http\Controllers\HomeController::class, 'pageGame'])->name('game');
    Route::get('/wheel/history/limit/{limit}/page/{page}', [App\Http\Controllers\HomeController::class, 'pageWheelHistory'])->name('pageWheelHistory');
    Route::get('/password', [App\Http\Controllers\HomeController::class, 'pagePassword'])->name('pagePassword');
    Route::post('/password/change', [App\Http\Controllers\HomeController::class, 'passwordChange'])->name('passwordChange');
    Route::get('/account/credit', [App\Http\Controllers\HomeController::class, 'getCredit'])->name('getCredit');


    Route::get('/game/slot/play/{productcode}/{gameid}', [App\Http\Controllers\GameController::class, 'playSlot'])->name('playSlot');
    Route::get('/wheel/point', [App\Http\Controllers\HomeController::class, 'getWheelPoint'])->name('getWheelPoint');
    Route::get('/wheel/last', [App\Http\Controllers\HomeController::class, 'getWheelLast'])->name('getWheelLast');
    Route::get('/wheel/spin', [App\Http\Controllers\HomeController::class, 'getWheelSpin'])->name('getWheelSpin');
    Route::post('/wheel/point/deal', [App\Http\Controllers\HomeController::class, 'wheelPointDeal'])->name('wheelPointDeal');
    Route::post('/promotion/request/{id}', [App\Http\Controllers\HomeController::class, 'promotionRequest'])->name('promotionRequest');
    Route::post('/promotion/cancel', [App\Http\Controllers\HomeController::class, 'promotionCancel'])->name('promotionCancel');
    Route::post('/cashback/request', [App\Http\Controllers\HomeController::class, 'requestCashBack'])->name('requestCashBack');
    Route::post('/affiliate/request', [App\Http\Controllers\HomeController::class, 'requestAffiliate'])->name('requestAffiliate');
    Route::post('/code/deal', [App\Http\Controllers\HomeController::class, 'codeDeal'])->name('codeDeal');
    // Route::get('/', function () {
    //     return view('wallet');
    // });

    // Route::get('/wallet', function () {
    //     return view('wallet');
    // })->name('wallet');

    // Route::get('/deposit', function () {
    //     return view('deposit');
    // })->name('deposit');

    // Route::get('/deposit/bank', function () {
    //     return view('deposit.bank');
    // })->name('deposit-bank');

    // Route::get('/deposit/wallet', function () {
    //     return view('deposit.wallet');
    // })->name('deposit-wallet');

    // Route::get('/withdraw', function () {
    //     return view('withdraw');
    // })->name('withdraw');

    // Route::get('/promotion', function () {
    //     return view('promotion');
    // })->name('promotion');

    // Route::get('/transactions', function () {
    //     return view('transactions');
    // })->name('transactions');

    // Route::get('/profile', function () {
    //     return view('profile');
    // })->name('profile');

    // Route::get('/affiliate', function () {
    //     return view('affiliate');
    // })->name('affiliate');

    // Route::get('/lucky-wheel', function () {
    //     return view('wheel');
    // })->name('lucky-wheel');

    // Route::get('/ranking', function () {
    //     return view('ranking');
    // })->name('ranking');

    // Route::get('/account', function () {
    //     return view('account');
    // })->name('account');
});