<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CirculationController;
use Illuminate\Support\Facades\Route;

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

    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    
    Route::get('/circulation', [CirculationController::class, 'index'])->name('circulation.index');
    Route::get('/circulation/create', [CirculationController::class, 'create'])->name('circulation.create');
    Route::post('/circulation', [CirculationController::class, 'store'])->name('circulation.store');
    Route::post('/circulation/{borrowRecord}/return', [CirculationController::class, 'returnBook'])->name('circulation.return');
});

require __DIR__.'/auth.php';
