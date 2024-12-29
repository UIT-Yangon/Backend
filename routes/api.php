<?php

use App\Http\Controllers\Admin\AdmissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Api\LabPublicationController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\UniCollaborationController;
use App\HTTP\Controllers\OrgCollaborationController;
use App\HTTP\Controllers\IndustryCollaborationController;
use App\Http\Controllers\VisionMissionController;

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

Route::get('/pdfs-grouped-by-type', [PdfController::class, 'getPdfsGroupedByType']);


Route::get('/fas',[FaqController::class, 'index']);
Route::get('/faq/{id}',[FaqController::class, 'show']);

Route::get('/collaboration/uni',[UniCollaborationController::class, 'index']);
Route::get('/collaboration/uni/{id}',[UniCollaborationController::class, 'show']);

Route::get('/collaboration/org',[OrgCollaborationController::class, 'index']);
Route::get('/collaboration/org/{id}',[OrgCollaborationController::class, 'show']);

Route::get('/collaboration/ind',[IndustryCollaborationController::class, 'index']);
Route::get('/collaboration/ind/{id}',[IndustryCollaborationController::class, 'show']);Route::get('/admission/requirements', [AdmissionController::class, 'showAdmissionRequirements']);

Route::get('/about', [VisionMissionController::class,'showAboutVMV']);
Route::get('/admission/requirements',[AdmissionController::class,'showAdmissionRequirements']);

