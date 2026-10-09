<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TruckController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ValidationController;


// Aurh Routes
Route::get('/', function () {return view('login');})->name('PageLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('check.auth');


Route::middleware([AdminAuth::class, RoleMiddleware::class.':1'])->group(function () {

    // Admin Routes
    Route::get('/getAdmin', [AdminController::class, 'index'])->name('admin.login');
    Route::get('/list_admin', [AdminController::class, 'showAdmin'])->name('list_admin');
    Route::put('/admin/update/{id}', [AdminController::class, 'update']);
    Route::post('/admin/store/', [AdminController::class, 'store']);
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);

});

Route::middleware([AdminAuth::class, RoleMiddleware::class.':1,2'])->group(function () {

    // Employee Routes
    Route::get('/getEmployees', [EmployeeController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'showEmploiees'])->name('list_employees');
    Route::post('/employees/store', [EmployeeController::class, 'store']);
    Route::put('/employees/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/employees/delete/{id}', [EmployeeController::class, 'destroy']);

    // Truck Routes
    Route::get('/getTruck', [TruckController::class, 'index']);
    Route::post('/truck/store', [TruckController::class, 'store']);
    Route::put('/truck/update/{id}', [TruckController::class, 'update']);
    Route::delete('/truck/delete/{id}', [TruckController::class, 'destroy']);

});

Route::middleware([AdminAuth::class, RoleMiddleware::class.':1,3'])->group(function () {

    // Stock Routes
    Route::get('/getStock', [StockController::class, 'index']);
    Route::get('/Stocks', [StockController::class, 'showStock'])->name('list_product');
    Route::post('/stock/store', [StockController::class, 'store']);
    Route::put('/stock/update/{id}', [StockController::class, 'update']);
    Route::delete('/stock/delete/{id}', [StockController::class, 'destroy']);

    // Menu Routes
    Route::get('/getMenu', [MenuController::class, 'index']);
    Route::post('/menu/store', [MenuController::class, 'store']);
    Route::put('/menu/update/{id}', [MenuController::class, 'update']);
    Route::delete('/menu/delete/{id}', [MenuController::class, 'destroy']);
   
});


Route::middleware([AdminAuth::class])->group(function () {

    Route::match(['get', 'post'], '/check-uniqueness', [ValidationController::class, 'checkUniqueness']);

    // Admin Routes
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile/update/{id}', [AdminController::class, 'updateProfile']);

    // Home Routes
    Route::get('/top-menus', [HomeController::class, 'getTopMenus'])->name('top.menus');
    Route::get('/orders-by-date', [HomeController::class, 'ordersByDate'])->name('orders.by.date');
    Route::get('/payment-stats', [HomeController::class, 'payement_Order']);

    // error.404
     Route::fallback(function () {
        return view('errors.404');
    });       

    
    // index
    Route::get('/index', function () {return view('index');})->name('index');
    
    Route::get('/dynamic-content', function (Request $request) {
        $view = $request->input('view', 'home');

        if (view()->exists($view)) {
            if (in_array($view,['list_employees','list_admin','profile','list_product'])) {
                return redirect()->route($view);
            }
            return response()->json(['html' => view($view)->render()]);
        }
        return response()->json(['error' => 'View not found'], 404);
    
    });
    
});


