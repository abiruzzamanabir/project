<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\ExpertiseController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;

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

Route::group(['middleware' => 'admin.redirect'], function () {
    Route::get('/admin-login', [AdminAuthController::class, 'showLoginPage'])->name('admin.login.page');
    Route::post('/admin-login', [AdminAuthController::class, 'Login'])->name('admin.login');
    Route::get('/forget-password', [AdminProfileController::class, 'ShowForgetPasswordPage'])->name('forget.password.page');
    Route::post('/forget-password', [AdminProfileController::class, 'ForgetPassword'])->name('forget.password');
    Route::get('/reset-password/{token?}/{email?}', [AdminProfileController::class, 'ResetPasswordLink'])->name('reset.password.page');
    Route::post('/reset-password/', [AdminProfileController::class, 'ResetPassword'])->name('reset.password');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminPageController::class, 'showDashboardPage'])->name('admin.dashboard.page');
    Route::get('/profile', [AdminPageController::class, 'showProfilePage'])->name('admin.profile.page');
    Route::post('/profile', [AdminPageController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/profile-password', [AdminPageController::class, 'updatePassword'])->name('admin.password.update');
    Route::get('/admin-logout', [AdminAuthController::class, 'Logout'])->name('admin.logout.page');
    Route::resource('/permission', AdminPermissionController::class);
    Route::resource('/role', AdminRoleController::class);
    Route::resource('/admin-user', AdminController::class);
    Route::get('/admin-user-status-update/{id}', [AdminController::class, 'updateStatus'])->name('admin.status.update');
    Route::get('/admin-user-trash-update/{id}', [AdminController::class, 'updateTrash'])->name('admin.trash.update');
    Route::get('/admin-trash', [AdminController::class, 'trashUsers'])->name('admin.trash');
    Route::resource('/client', ClientController::class);
    Route::resource('/slider', SliderController::class);
    Route::get('/slider-status-update/{id}', [SliderController::class, 'updateStatus'])->name('slider.status.update');
    Route::get('/slider-trash-update/{id}', [SliderController::class, 'updateTrash'])->name('slider.trash.update');
    Route::get('/slider-trash', [SliderController::class, 'trashUsers'])->name('slider.trash');
    Route::resource('/expertise', ExpertiseController::class);
    Route::resource('/vision', VisionController::class);
    Route::get('/vision-status-update/{id}', [VisionController::class, 'updateStatus'])->name('vision.status.update');
    Route::resource('/testimonial', TestimonialController::class);
    Route::get('/testimonial-status-update/{id}', [TestimonialController::class, 'updateStatus'])->name('testimonial.status.update');
    Route::get('/testimonial-trash-update/{id}', [TestimonialController::class, 'updateTrash'])->name('testimonial.trash.update');
    Route::get('/testimonial-trash', [TestimonialController::class, 'trashUsers'])->name('testimonial.trash');
    Route::resource('/team-member', TeamController::class);
    Route::get('/team-member-status-update/{id}', [TeamController::class, 'updateStatus'])->name('team.member.status.update');
    Route::get('/team-member-trash-update/{id}', [TeamController::class, 'updateTrash'])->name('team.member.trash.update');
    Route::get('/team-member-trash', [TeamController::class, 'trashUsers'])->name('team.member.trash');
    Route::resource('/skill', SkillController::class);
    Route::get('/skill-status-update/{id}', [SkillController::class, 'updateStatus'])->name('skill.status.update');
    Route::resource('/service', ServiceController::class);
    Route::get('/service-status-update/{id}', [ServiceController::class, 'updateStatus'])->name('service.status.update');
    Route::resource('/pricing-table', PricingController::class);
    Route::get('/pricing-table-status-update/{id}', [PricingController::class, 'updateStatus'])->name('pricing.table.status.update');
    Route::resource('/counter', CounterController::class);
    Route::get('/counter-status-update/{id}', [CounterController::class, 'updateStatus'])->name('counter.status.update');
});


Route::get('/', [FrontendController::class, 'showHomePage'])->name('home.page');
Route::get('/about', [FrontendController::class, 'showAboutPage'])->name('about.page');
Route::get('/pricing', [FrontendController::class, 'showPricingPage'])->name('pricing.page');
