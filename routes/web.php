<?php

use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MentorController;


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
});

Route::get('templating', function () {
    return view('layouts.app');
})->name('templating');

Route::resource('students', StudentController::class);
Route::resource('divisions', DivisionController::class);
Route::resource('mentors', MentorController::class);

Route::resource('roles',RoleController::class)->only([
    'index', 'store','update'
]);

Route::resource('permissions',PermissionController::class)->only([
    'index', 'store','update'
]);

require __DIR__.'/auth.php';
