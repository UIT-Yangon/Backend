<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Api\LabPublicationController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\AlumniController;




Route::post('/login', [AdminAuthController::class, 'login']);
Route::post('/register', [AdminAuthController::class, 'register']);

Route::get('/posts/{type}', [PostController::class, 'index']);
// Route::get('/posts/{id}', function()
// {
//     dd('Hello');
// });
Route::get('/news/{id}',[PostController::class,'show']);

Route::get('/staff', [StaffController::class, 'index']);
Route::get('/staff/{id}', [StaffController::class, 'show']);


///-------------------------Conferences -------------------------------////

Route::get('/conferences',[ConferenceController::class,'index']); // conferences title list
Route::get('/conferences/{id}',[ConferenceController::class,'show']); // conferences detail
///--------------------------------------------------------------------------
Route::get('/subjects', [SubjectController::class, 'index']);
Route::get('/subjects/{id}', [SubjectController::class, 'show']);

Route::get('/alumni', [AlumniController::class, 'index']);
Route::get('/alumni/{id}', [AlumniController::class, 'show']);

// Lab Publications 
Route::get('/lab/publications',[LabPublicationController::class,'index']);
Route::get('/lab/publications/{lab}',[LabPublicationController::class,'filterByLab']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AdminAuthController::class, 'logout']);
});





