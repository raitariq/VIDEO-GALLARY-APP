<?php

use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\VideoController as FrontendVideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/',[FrontendVideoController::class,'index'])->name('user-videos');
    Route::post('/video/{video}/like-toggle', [FrontendVideoController::class, 'toggleLike'])->name('video.like-toggle');
    Route::post('/videos/{video}/comment', [FrontendVideoController::class, 'comment']);
    Route::middleware([CheckUserType::class])->group(function () {
        Route::resource('video',VideoController::class);
        Route::get('video-datatable',[VideoController::class,'datatable'])->name('video-datatable');
        Route::resource('users',UserController::class);
        Route::get('users-datatable',[UserController::class,'datatable'])->name('users-datatable');
        Route::put('change-user-status',[UserController::class,'changeStatus'])->name('change-user-status');
    });
    
   
});


require __DIR__.'/auth.php';
