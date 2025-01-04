<?php

use App\Http\Controllers\Auth\RegisteredEmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GymMemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [GymMemberController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/members', [GymMemberController::class, 'index'])->name('members.index');
    Route::get('/members/create', [GymMemberController::class, 'create'])->name('members.create');
    Route::post('/members', [GymMemberController::class, 'store'])->name('members.store');
    Route::get('/members/{id}/edit', [GymMemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{id}', [GymMemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{id}', [GymMemberController::class, 'destroy'])->name('members.destroy');


    Route::get('register', [RegisteredEmployeeController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredEmployeeController::class, 'store']);


    Route::get('/employees', [RegisteredEmployeeController::class, 'index'])->name('employees');

});

require __DIR__.'/auth.php';
