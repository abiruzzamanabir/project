<?php

use App\Models\PostCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VisionController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\PostTagController;
use App\Http\Controllers\Admin\PricingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\ExpertiseController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ProductTagController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\PortfolioCategoryController;

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

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});
Route::get('/queue-job', function () {
    Artisan::call('queue:work');
});

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
    Route::get('/expertise-status-update/{id}', [ExpertiseController::class, 'updateStatus'])->name('expertise.status.update');
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
    Route::resource('/portfolio-category', PortfolioCategoryController::class);
    Route::get('/portfolio-category-status-update/{id}', [PortfolioCategoryController::class, 'updateStatus'])->name('portfolio.category.status.update');
    Route::resource('/portfolio', PortfolioController::class);
    Route::get('/portfolio-status-update/{id}', [PortfolioController::class, 'updateStatus'])->name('portfolio.status.update');
    Route::resource('/post-tag', PostTagController::class);
    Route::get('/post-tag-status-update/{id}', [PostTagController::class, 'updateStatus'])->name('post.tag.status.update');
    Route::resource('/post-category', PostCategoryController::class);
    Route::get('/post-category-status-update/{id}', [PostCategoryController::class, 'updateStatus'])->name('post.category.status.update');
    Route::resource('/post', PostController::class);
    Route::get('/post-status-update/{id}', [PostController::class, 'updateStatus'])->name('post.status.update');
    Route::resource('/products-tag', ProductTagController::class);
    Route::get('/products-tag-status-update/{id}', [ProductTagController::class, 'updateStatus'])->name('product.tag.status.update');
    Route::resource('/products-category', ProductCategoryController::class);
    Route::get('/products-category-status-update/{id}', [ProductCategoryController::class, 'updateStatus'])->name('product.category.status.update');
    Route::resource('/products', ProductController::class);
    Route::get('/products-status-update/{id}', [ProductController::class, 'updateStatus'])->name('product.status.update');
    Route::resource('/theme', ThemeController::class);

});


Route::get('/', [FrontendController::class, 'showHomePage'])->name('home.page');
Route::get('/about', [FrontendController::class, 'showAboutPage'])->name('about.page');
Route::get('/pricing', [FrontendController::class, 'showPricingPage'])->name('pricing.page');
Route::get('/single-portfolio/{slug}', [FrontendController::class, 'showSingleportfolioPage'])->name('portfolio.single.page');
Route::get('/single-post/{slug}', [FrontendController::class, 'showSinglepostPage'])->name('post.single.page');
Route::get('/blog', [FrontendController::class, 'showBlogPage'])->name('blog.page');
Route::get('/blog/category/{slug}', [FrontendController::class, 'showBlogCategoryPage'])->name('blog.category.page');
Route::get('/blog/tag/{slug}', [FrontendController::class, 'showBlogTagPage'])->name('blog.tag.page');
Route::get('/blog/search/', [FrontendController::class, 'blogSearch'])->name('blog.search');
Route::get('/shop', [FrontendController::class, 'showShopPage'])->name('shop.page');
Route::get('/single-product/{slug}', [FrontendController::class, 'showSingleProductPage'])->name('product.single.page');
Route::get('/product/category/{slug}', [FrontendController::class, 'showProductCategoryPage'])->name('product.category.page');
Route::get('/product/tag/{slug}', [FrontendController::class, 'showProductTagPage'])->name('product.tag.page');
Route::get('/product/search/', [FrontendController::class, 'productSearch'])->name('product.search');
