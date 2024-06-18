<?php

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
