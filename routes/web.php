<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Product;
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



//admin authentication page
Route::middleware(['admin_auth'])->group(function () {
    // login, register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, "loginPage"])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});


//user authentication page
Route::middleware(['user_auth'])->group(function () {
    // login, register
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, "loginPage"])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});



//main
Route::middleware(['auth'])->group(function () {


    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');



    //admin
    Route::middleware('admin_auth')->group(function () {


        //admin profile dropdown
        Route::group(['prefix' => 'admin'], function () {

            //account profile
            Route::get('account', [AdminController::class,'account'])->name('admin#account');
            Route::get('edit', [AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class,'update'])->name('admin#update');

            //admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRolePage'])->name('admin#changeRolePage');
            Route::post('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');


             //password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('password/change', [AdminController::class, 'changePassword'])->name('admin#changePassword');

        });


        //admin category
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });


        //admin products
        Route::group(['prefix' => 'products'], function () {
            Route::get('list', [ProductController::class, 'list'])->name('products#list');
            Route::get('createPage', [ProductController::class, 'createPage'])->name('products#createPage');
            Route::post("create", [ProductController::class, 'create'])->name('products#create');
            Route::get("delete/{id}", [ProductController::class, 'delete'])->name('products#delete');
            Route::get("view/{id}", [ProductController::class, 'view'])->name('products#view');
            Route::get("edit/{id}", [ProductController::class, 'edit'])->name('products#edit');
            Route::post('update', [ProductController::class, 'update'])->name('products#update');

        });

    });



    //user

    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('/home', [UserController::class, 'home'])->name('user#home');
        Route::get('/filter/{id}', [UserController::class, 'filter'])->name('user#filter');

        //pizza details
        Route::group(['prefix' => 'pizza'], function () {
            Route::get('details/{id}', [UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');
        });

        //pizza cart
        Route::group(['prefix' => 'cart'], function () {
            Route::get('list', [UserController::class, 'cartList'])->name('user#cartList');
        });


        //password
        Route::group(['prefix' => 'password'], function () {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        //account
        Route::group(['prefix' => 'account'], function () {
            Route::get('change', [UserController::class, 'changeAccountPage'])->name('user#changeAccountPage');
            Route::post('change/{id}', [UserController::class, 'changeAccount'])->name('user#changeAccount');
        });


        //ajax testing
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');

        });
    });




});
