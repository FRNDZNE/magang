<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\LogbookImageController;
use App\Http\Controllers\ScoreValueController;



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
Route::resource('interns', InternController::class);
Route::resource('scores', ScoreController::class);
Route::resource('score-values', ScoreValueController::class);


Route::resource('roles',RoleController::class)->only([
    'index', 'store','update','destroy'
]);

Route::resource('permissions',PermissionController::class)->only([
    'index', 'store','update','destroy'
]);

require __DIR__.'/auth.php';
