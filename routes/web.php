<?php

use App\Http\Controllers\Admin\ConferenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\LabPublicationController;
use App\Models\LabPublication;

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
    return view('authentication.login');
})->name('login');




    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin#login');
    Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin#register');

    Route::middleware(['check.role:admin'])->group(function () {
        
Route::prefix('/news')->group(function(){
    Route::get('/list',[NewsController::class,'list'])->name('news#list');
    Route::get('/create',[NewsController::class,'create'])->name('news#create');
    Route::post('/store',[NewsController::class,'store'])->name('news#store');
    Route::get('/detail/{id}',[NewsController::class,'detail'])->name('news#detailPage');
    Route::get('/edit/{id}',[NewsController::class,'editPage'])->name('news#editPage');
    Route::get('/delete/{id}',[NewsController::class,'delete'])->name('news#deletePage');
    Route::get('/back',[NewsController::class, 'Back'])->name('news#back');
    Route::post('/update',[NewsController::class, 'update'])->name('news#update');
    Route::get('/delete/image/{id}',[NewsController::class, 'deleteImage'])->name('news#deleteImage');
});

Route::prefix('/conference')->group(function(){
    Route::post('/add/image/{id}',[ConferenceController::class,'addImage'])->name('conf#addImage');
    Route::get('/list',[ConferenceController::class, 'list'])->name('conf#list');
    Route::get('/create',[ConferenceController::class,'createPage'])->name('conf#createPage');
    Route::post('/create',[ConferenceController::class,'create'])->name('conf#create');
    Route::get('/detail/{id}',[ConferenceController::class,'detail'])->name('conf#detailPage');
    Route::get('/commitee/{id}/{type}',[ConferenceController::class,'commitee'])->name('conf#commiteePage');
    Route::get('/delete/{id}',[ConferenceController::class,'delete'])->name('conf#deletePage');
    Route::get('/delete/member/{id}',[ConferenceController::class,'deleteMember'])->name('conf#deleteMember');
    Route::get('/edit/member/{id}',[ConferenceController::class,'editMemberPage'])->name('conf#editMemberPage');
    Route::post('/edit/member/{id}',[ConferenceController::class,'editMember'])->name('conf#editMember');
    Route::get('/add/member/{id}',[ConferenceController::class,'addMemberPage'])->name('conf#addMemberPage');
    Route::post('/add/member/{id}',[ConferenceController::class,'addMember'])->name('conf#addMember');
    Route::get('/edit/conf/{id}',[ConferenceController::class,'editPage'])->name('conf#editPage');
    Route::post('/update',[ConferenceController::class,'updateInfo'])->name('conf#updateInfo');
    Route::get('/delete/img/{id}/{name}',[ConferenceController::class,'deleteImg'])->name('conf#deleteImg');
});


        Route::get('/', [AdminAuthController::class, 'showWelcome'])->name('welcome');
        Route::get('/admin/changepassword',[AdminAuthController::class, 'showChangePasswordForm'])->name('changepassword');
        Route::post('/admin/changepassword', [AdminAuthController::class, 'changePassword']) ->name('admin#changepassword');
        Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
        // publications 
        Route::prefix('publications')->group(function () {
            Route::get('/list',[LabPublicationController::class,'list'])->name('publication#list');
            Route::get('/create',[LabPublicationController::class,'createPage'])->name('publication#create');
            Route::post('/store',[LabPublicationController::class,'store'])->name('publication#store');
            Route::get('/delete/{id}',[LabPublicationController::class,'delete'])->name('publication#delete');
        });
    
    
    });
    

    Route::prefix('/staff')->group(function(){
        Route::get('/list',[StaffController::class,'list'])->name('staff#list');
        Route::get('/create', [StaffController::class, 'create'])->name('staff#create');
        Route::post('/store',[StaffController::class,'store'])->name('staff#store');
        Route::get('/detail/{id}',[StaffController::class,'detail'])->name('staff#detail');
        Route::get('/delete/{id}',[StaffController::class,'delete'])->name('staff#delete');
        Route::get('/back',[StaffController::class, 'Back'])->name('staff#back');
        Route::get('/edit/{id}',[StaffController::class, 'edit'])->name('staff#edit');
        Route::post('/edit/{id}' , [StaffController::class, 'update'])->name('staff#update');

        Route::get('/staff/{id}/createPublicaion',[StaffController::class, 'createPublicaionPage'])->name('staff#createPublicationPage');
        Route::post('/staff/storePublicaion',[StaffController::class, 'createPublicaion'])->name('staff#storePublication');
        Route::get('/staff/publication/delete/{id}/{staffId}',[StaffController::class, 'deleteStaffPub'])->name('staff#publications#delete');
    });
    
    
    

    

    