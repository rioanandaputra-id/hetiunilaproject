<?php

use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\MeetingController;
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

Route::controller(MonitoringController::class)
    ->group(function () {
        Route::get('/', 'monitoring')->name('monitoring');
    });

Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
Route::get('/meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
Route::post('/store', [MeetingController::class, 'store'])->name('meetings.store');
Route::get('/meetings/edit/{meeting}', [MeetingController::class, 'edit'])->name('meetings.edit');
Route::put('/meetings/update/{meeting}', [MeetingController::class, 'update'])->name('meetings.update');
Route::delete('/meetings/destroy/{meeting}', [MeetingController::class, 'destroy'])->name('meetings.destroy');
