<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminPermissionController;

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

Route::group(['middleware'=>'admin.redirect'],function(){
Route::get('/admin-login', [AdminAuthController::class,'showLoginPage'])->name('admin.login.page');
Route::post('/admin-login', [AdminAuthController::class,'Login'])->name('admin.login');

});

Route::group(['middleware'=>'admin'],function(){
    Route::get('/dashboard', [AdminPageController::class,'showDashboardPage'])->name('admin.dashboard.page');
    Route::get('/admin-logout', [AdminAuthController::class,'Logout'])->name('admin.logout.page');
    Route::resource('/permission',AdminPermissionController::class);
});



