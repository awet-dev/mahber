<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('attendances', AttendanceController::class)->except('show');
    Route::resource('users', UserController::class)->except('show');
    Route::post('users/{user}/request_email_verification', [UserController::class, 'requestEmailVerification'])
        ->name('users.request_email_verification');

    Route::resource('users.payments', PaymentController::class)->except('show');
});

Route::group([
    'prefix' => 'child',
    'as' => 'child.',
    'middleware' => ['auth:child', 'verified:child.verification.notice']
], function () {
    Route::get('/', [ChildController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix' => 'schedules',
    'as' => 'schedules.',
    'middleware' => ['auth', 'verified']
], function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('index');
    Route::put('/{schedule}', [ScheduleController::class, 'update'])->name('update');
    Route::get('/{schedule}/edit', [ScheduleController::class, 'edit'])->name('edit');
});


Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', 'verified', 'has_role:admin']
], function () {

    Route::group([
        'prefix' => 'schedules',
        'as' => 'schedules.',
    ], function () {
        Route::get('/', [AdminController::class, 'indexSchedule'])->name('index');
        Route::post('/', [AdminController::class, 'storeSchedule'])->name('store');
        Route::get('/create', [AdminController::class, 'createSchedule'])->name('create');
        Route::put('/{schedule}', [AdminController::class, 'updateSchedule'])->name('update');
        Route::delete('/{schedule}', [AdminController::class, 'destroySchedule'])->name('destroy');
        Route::get('/{schedule}/edit', [AdminController::class, 'editSchedule'])->name('edit');
    });
});

require __DIR__ . '/auth.php';
