<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ItemListController;
use App\Http\Controllers\EmailVerificationController;

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

// 会員登録
Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'register']);
//ユーザー認証
//Route::get('email/verify/{token}', [EmailVerificationController::class, 'verify']);

// ログイン
Route::get('/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'login']);

// ログアウト
Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

// 打刻 認証済みのユーザーだけがアクセスできるよう認証ミドルウェアを設定
Route::middleware(['auth'])->group(function () {
    // '/'にアクセスされたときにAttendanceControllerのindexメソッドを呼び出し、この処理をattendance.indexと名付ける。
    Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('attendance/start', [AttendanceController::class, 'startWork'])->name('attendance.startWork');
    Route::post('attendance/end', [AttendanceController::class, 'endWork'])->name('attendance.endWork');
    Route::post('attendance/start-break', [AttendanceController::class, 'startBreak'])->name('attendance.startBreak');
    Route::post('attendance/end-break', [AttendanceController::class, 'endBreak'])->name('attendance.endBreak');

    Route::get('/attendance', [ItemListController::class, 'index'])->name('itemList.index');
    Route::post('/attendance/change-date/{direction}', [ItemListController::class, 'changeDate'])->name('itemList.changeDate');
});


