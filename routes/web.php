<?php

use App\Http\Controllers\Backend\CvwController;
use App\Http\Controllers\Frontend\CvwController AS FrCvwController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\PmscController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\TimelineController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;

// frontend
Route::prefix('/')->group(function () {
    Route::get('getDataCvw', [FrCvwController::class, 'getData']);

    Route::get('/', function () {
        return view('frontend.home.index');
    });
    Route::get('about', function () {
        return 'About';
    });
    Route::get('contact', function () {
        return 'Contact';
    });
    Route::prefix('monitoring')->group(function () {
        Route::get('cvw', [FrCvwController::class, 'index'])->name('monitoring.cvw.index');
        Route::get('pmsc', [PmscController::class, 'indexxx'])->name('monitoring.pmsc.indexxx');
    });
});

// backend
Route::prefix('backend')->group(function () {
    Route::prefix('masterdata')->group(function () {
        Route::prefix('project')->group(function () {
            Route::get('/', [ProjectController::class, 'edit'])->name('backend.masterdata.project.index');
            Route::put('/', [ProjectController::class, 'update'])->name('backend.masterdata.project.update');
        });
        Route::prefix('location')->group(function () {
            Route::get('/', [LocationController::class, 'index'])->name('backend.masterdata.location.index');
            Route::get('data', [LocationController::class, 'data'])->name('backend.masterdata.location.data');
            Route::get('create', [LocationController::class, 'create'])->name('backend.masterdata.location.create');
            Route::post('/', [LocationController::class, 'store'])->name('backend.masterdata.location.store');
            Route::get('{id}/edit', [LocationController::class, 'edit'])->name('backend.masterdata.location.edit');
            Route::put('{id}', [LocationController::class, 'update'])->name('backend.masterdata.location.update');
            Route::delete('{id}', [LocationController::class, 'destroy'])->name('backend.masterdata.location.destroy');
        });
        Route::prefix('timeline')->group(function () {
            Route::get('/', [TimelineController::class, 'index'])->name('backend.masterdata.timeline.index');
            Route::get('data', [TimelineController::class, 'data'])->name('backend.masterdata.timeline.data');
            Route::get('create', [TimelineController::class, 'create'])->name('backend.masterdata.timeline.create');
            Route::post('/', [TimelineController::class, 'store'])->name('backend.masterdata.timeline.store');
            Route::get('{id}/edit', [TimelineController::class, 'edit'])->name('backend.masterdata.timeline.edit');
            Route::put('{id}', [TimelineController::class, 'update'])->name('backend.masterdata.timeline.update');
            Route::delete('{id}', [TimelineController::class, 'destroy'])->name('backend.masterdata.timeline.destroy');
        });
    });
    Route::prefix('monitoring')->group(function () {
        Route::prefix('cvw')->group(function () {
            Route::get('/', [CvwController::class, 'index'])->name('backend.monitoring.cvw.index');
            Route::get('data', [CvwController::class, 'data'])->name('backend.monitoring.cvw.data');
            Route::get('create', [CvwController::class, 'create'])->name('backend.monitoring.cvw.create');
            Route::post('/', [CvwController::class, 'store'])->name('backend.monitoring.cvw.store');
            Route::get('{cvw}/edit', [CvwController::class, 'edit'])->name('backend.monitoring.cvw.edit');
            Route::put('{cvw}', [CvwController::class, 'update'])->name('backend.monitoring.cvw.update');
            Route::delete('{cvw}', [CvwController::class, 'destroy'])->name('backend.monitoring.cvw.destroy');
        });
        Route::prefix('pmsc')->group(function () {
            Route::get('/', [PmscController::class, 'index'])->name('backend.monitoring.pmsc.index');
            Route::get('data', [PmscController::class, 'data'])->name('backend.monitoring.pmsc.data');
            Route::get('create', [PmscController::class, 'create'])->name('backend.monitoring.pmsc.create');
            Route::post('/', [PmscController::class, 'store'])->name('backend.monitoring.pmsc.store');
            Route::get('edit/{pmsc}', [PmscController::class, 'edit'])->name('backend.monitoring.pmsc.edit');
            Route::put('{pmsc}', [PmscController::class, 'update'])->name('backend.monitoring.pmsc.update');
            Route::delete('{pmsc}', [PmscController::class, 'destroy'])->name('backend.monitoring.pmsc.destroy');
        });
    });
});
