<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommitController;
use App\Http\Controllers\HistoryController;

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('history.index');
    });

    Route::get('/dashboard', function () {
        return redirect()->route('history.index');
    })->name('dashboard');

    Route::get('downloadFile/{history}', [HistoryController::class, 'downloadFile'])->name('downloadFile');

    Route::resources([
        'history' => HistoryController::class,
        'comment' => CommitController::class,
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
