<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\Admin\DashboardAdmController;
use App\Http\Controllers\Admin\CategoryAdmController;
use App\Http\Controllers\Admin\UserAdmController;
use App\Http\Controllers\Admin\ProductAdmController;
use App\Http\Controllers\Admin\ProductGalleryController;


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


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/products/{id}', [ProductController::class, 'detail'])->name('products-detail');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('detail-add');

Route::get('/carts', [CartController::class, 'index'])->name('cart');
Route::delete('/cart{id}', [CartController::class, 'delete'])->name('cart-delete');

Route::get('/success', [CartController::class, 'success'])->name('success');
Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');
Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');



Route::group(['middleware' => ['auth']], function () {

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])
        ->name('dashboard-product');
    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])
        ->name('dashboard-product-create');
    Route::post('/dashboard/products', [DashboardProductController::class, 'store'])
        ->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class, 'details'])
        ->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', [DashboardProductController::class, 'update'])
        ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])
        ->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])
        ->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])
        ->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'details'])
        ->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', [DashboardTransactionController::class, 'update'])
        ->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])
        ->name('dashboard-settings-store');
    Route::get('/dashboard/account', [DashboardSettingController::class, 'account'])
        ->name('dashboard-settings-account');
    Route::post('/dashboard/update/{redirect}', [DashboardSettingController::class, 'update'])
        ->name('dashboard-settings-redirect');

});



Route::prefix('admin')
    ->namespace('Admin')
   // ->middleware(['auth', 'admin'])
    ->group(function()
    {
        Route::get('/', [DashboardAdmController::class, 'index'])->name('admin-dashboard');
        
        //Route::resource('category', CategoryAdmController::class);
        //Route::resource('category', 'CategoryAdmController');
        
         Route::get('/category', [CategoryAdmController::class, 'index'])->name('category-index');
         Route::get('/category/create', [CategoryAdmController::class, 'create'])->name('category.create');
         Route::post('/store/category', [CategoryAdmController::class, 'store'])->name('category.store');
         Route::get('/category/{id}/show', [CategoryAdmController::class, 'show'])->name('category.show');
         Route::get('/category/{id}/edit', [CategoryAdmController::class, 'edit'])->name('category.edit');
         Route::put('/category/{id}/update', [CategoryAdmController::class, 'update'])->name('category.update');
         Route::delete('/category/{id}', [CategoryAdmController::class, 'destroy'])->name('category.destroy');

         Route::get('/user', [UserAdmController::class, 'index'])->name('user-index');
         Route::get('/user/create', [UserAdmController::class, 'create'])->name('user.create');
         Route::post('/store/user', [UserAdmController::class, 'store'])->name('user.store');
         Route::get('/user/{id}/show', [UserAdmController::class, 'show'])->name('user.show');
         Route::get('/user/{id}/edit', [UserAdmController::class, 'edit'])->name('user.edit');
         Route::put('/user/{id}/update', [UserAdmController::class, 'update'])->name('user.update');
         Route::delete('/user/{id}', [UserAdmController::class, 'destroy'])->name('user.destroy');

         Route::get('/product', [ProductAdmController::class, 'index'])->name('product-index');
         Route::get('/product/create', [ProductAdmController::class, 'create'])->name('product.create');
         Route::post('/store/product', [ProductAdmController::class, 'store'])->name('product.store');
         Route::get('/product/{id}/show', [ProductAdmController::class, 'show'])->name('product.show');
         Route::get('/product/{id}/edit', [ProductAdmController::class, 'edit'])->name('product.edit');
         Route::put('/product/{id}/update', [ProductAdmController::class, 'update'])->name('product.update');
         Route::delete('/product/{id}/delete', [ProductAdmController::class, 'destroy'])->name('product.destroy');

         Route::get('/gallery', [ProductGalleryController::class, 'index'])->name('product-gallery.index');
         Route::get('/gallery/create', [ProductGalleryController::class, 'create'])->name('product-gallery.create');
         Route::post('/store/gallery', [ProductGalleryController::class, 'store'])->name('product-gallery.store');
         Route::get('/gallery/{id}/show', [ProductGalleryController::class, 'show'])->name('product-gallery.show');
         Route::get('/gallery/{id}/edit', [ProductGalleryController::class, 'edit'])->name('product-gallery.edit');
         Route::put('/gallery/{id}/update', [ProductGalleryController::class, 'update'])->name('product-gallery.update');
         Route::delete('/gallery/{id}/delete', [ProductGalleryController::class, 'destroy'])->name('product-gallery.destroy');


    });

    


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
