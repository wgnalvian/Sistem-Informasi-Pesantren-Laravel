<?php

use App\Http\Controllers\FinanceController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SantriController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['isLogin'])->group(function () {

    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/action-register', [LoginController::class, 'handleRegister'])->name('register.action');
    Route::middleware(['email'])->post('/action-login', [LoginController::class, 'handleLogin'])->name('login.action');


    Route::middleware(['isTrueConfirmEmail'])->group(function(){

        Route::get('/confirm-email', [LoginController::class, 'emailConfirmation']);
        Route::post('/send-email', [LoginController::class, 'sendEmail']);
        Route::get('/success-send-email', [LoginController::class, 'sendEmailSuccess']);
        Route::get('/handle-confirm-email/{token}', [LoginController::class, 'handleConfirmEmail']);
    });
});





Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name(('dashboard'));
    Route::get('/input-pemasukan', [FinanceController::class, 'inputIncome']);
    Route::post('/aksi-input-pemasukan', [FinanceController::class, 'handleInputIncome'])->name('handleInputIncome');
    Route::get('/input-pengeluaran', [FinanceController::class, 'inputExpenditure']);
    Route::post('/aksi-input-pengeluaran', [FinanceController::class, 'handleInputExpenditure'])->name('handleInputExpenditure');
    Route::get('/finance-data', [FinanceController::class, 'index'])->name('finance-data');
    Route::post('/finance/delete/{id}', [FinanceController::class, 'deleteFinance']);
    Route::get('/finance/update/{id}', [FinanceController::class, 'updateFinance']);
    Route::post('/finance/income-update/{id}', [FinanceController::class, 'handleUpdateIncome']);
    Route::post('/finance/expenditure-update/{id}', [FinanceController::class, 'handleUpdateExpenditure']);
    Route::post('/finance/search', [FinanceController::class, 'handleFinanceSearch']);
    Route::post('/finance/pdf', [FinanceController::class, 'handleFinancePdf']);
    Route::get('/profile', [GeneralController::class, 'index']);
    Route::get('/profile/edit', [GeneralController::class, 'profileEdit']);
    Route::post('/profile/update', [GeneralController::class, 'handleProfileEdit']);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/santri/create', [SantriController::class, 'create']);
    Route::post('/santri/handleCreate', [SantriController::class, 'handleCreate']);
    Route::get('/santri', [SantriController::class, 'index']);
    Route::post('/santri/delete/{id}', [SantriController::class, 'delete']);
    Route::post('/santri/update/{id}', [SantriController::class, 'update']);
    Route::get('/change-password', [GeneralController::class, 'changePassword']);
    Route::post('/handle-change-password', [GeneralController::class, 'handleChangePassword']);
});
