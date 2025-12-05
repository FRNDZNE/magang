<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ScoreValueController;
use App\Http\Controllers\LogbookImageController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    $role = Auth::user()->getRoleNames()->first();
    if ($role == 'admin') {
        return redirect()->route('dashboard.admin');
    } elseif ($role == 'mentor') {
        return redirect()->route('dashboard.mentor');
    } elseif ($role == 'student') {
        return redirect()->route('dashboard.student');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->group(function () {
    Route::get('/admin',[DashboardController::class,'admin'])->middleware('role:admin')->name('dashboard.admin');
    Route::get('/mentor',[DashboardController::class,'mentor'])->middleware('role:mentor')->name('dashboard.mentor');
    Route::get('/student',[DashboardController::class,'student'])->middleware('role:student')->name('dashboard.student');
})->middleware(['auth', 'verified']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::resource('students', StudentController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('mentors', MentorController::class);
    Route::resource('scores', ScoreController::class);

    Route::get('/notifications',[NotificationController::class,'index'])->name("notifications.index");
    Route::get('mark-read-all',[NotificationController::class,'markAsRead'])->name('markAll');
    Route::get('mark-read-by-id/{id}',[NotificationController::class,'markAsReadById'])->name('markId');

    Route::get('interns/history',[InternController::class,'history'])->name('interns.history');
    Route::get('interns/accepted',[InternController::class,'accepted'])->name('interns.accepted');
    Route::get('interns/history/{student}',[InternController::class,'history_student'])->name('interns.history.student');
    Route::put('interns/{intern}/process', [InternController::class, 'process'])->name('interns.process');
    Route::put('interns/{intern}/accept', [InternController::class, 'accept'])->name('interns.accept');
    Route::delete('interns/{intern}/denied', [InternController::class, 'denied'])->name('interns.denied');
    Route::resource('interns', InternController::class);
    Route::put('interns/{intern}/attendance/validate',[AttendanceController::class,'validationMentor'])->name('interns.attendance.validation');
    Route::resource('interns.attendance', AttendanceController::class)->only(['index','store']);
    Route::resource('interns.score-values', ScoreValueController::class)->only(['index','store']);
    Route::resource('interns.logbooks', LogbookController::class);
    Route::resource('interns.logbooks.images',LogbookImageController::class)->only(['index','store']);
    
    Route::resource('roles',RoleController::class)->only([
        'index', 'store','update','destroy'
    ]);
    
    Route::resource('permissions',PermissionController::class)->only([
        'index', 'store','update','destroy'
    ]);
});

require __DIR__.'/auth.php';
