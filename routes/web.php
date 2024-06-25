<?php

use App\Http\Controllers\Admin\ConferenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/news')->group(function(){
    Route::get('/list',[NewsController::class,'list'])->name('news#list');
    Route::get('/create',[NewsController::class,'create'])->name('news#create');
    Route::post('/store',[NewsController::class,'store'])->name('news#store');
    Route::get('/detail/{id}',[NewsController::class,'detail'])->name('news#detailPage');
    Route::get('/edit/{id}',[NewsController::class,'editPage'])->name('news#editPage');
    Route::get('/delete/{id}',[NewsController::class,'delete'])->name('news#deletePage');
    Route::get('/back',[NewsController::class, 'Back'])->name('news#back');
});

Route::prefix('/conference')->group(function(){
    Route::get('/list',[ConferenceController::class, 'list'])->name('conf#list');
    Route::get('/detail/{id}',[ConferenceController::class,'detail'])->name('conf#detailPage');
    Route::get('/commitee/{id}/{type}',[ConferenceController::class,'commitee'])->name('conf#commiteePage');
    Route::get('/delete/{id}',[ConferenceController::class,'delete'])->name('conf#deletePage');
    Route::get('/delete/member/{id}',[ConferenceController::class,'deleteMember'])->name('conf#deleteMember');
    Route::get('/edit/member/{id}',[ConferenceController::class,'editMemberPage'])->name('conf#editMemberPage');
    Route::post('/edit/member/{id}',[ConferenceController::class,'editMember'])->name('conf#editMember');
});
