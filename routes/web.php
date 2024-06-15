<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/detail/{id}',[NewsController::class,'detailPage'])->name('news#detailPage');
    Route::get('/edit/{id}',[NewsController::class,'editPage'])->name('news#editPage');
});
