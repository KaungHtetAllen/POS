<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::middleware(['admin_auth'])->group(function () {
    // login, register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, "loginPage"])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});



Route::middleware(['user_auth'])->group(function () {
    // login, register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, "loginPage"])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});




Route::middleware(['auth'])->group(function () {


    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');



    //admin
    Route::middleware('admin_auth')->group(function () {

        //admin category
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        //admin profile
        Route::group(['prefix' => 'admin'], function () {
            //password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/change', [AdminController::class, 'changePassword'])->name('admin#changePassword');

            //account profile
            Route::get('account', [AdminController::class,'account'])->name('admin#account');
            Route::get('edit', [AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class,'update'])->name('admin#update');
        });


    });




    //user
    Route::middleware('user_auth')->group(function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('home', function () {
                return view("user.home");
            })->name('user#home');
        });
    });


});
