<?php

use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Artist\Artwork\ArtworkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\Cart\CartController;
use App\Http\Controllers\User\MainController;
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

//Auth
Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerView'])->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//User
Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/artist', [MainController::class, 'artist'])->name('artist');
Route::get('/artist/search', [MainController::class, 'search'])->name('artist.search');
Route::get('/artwork', [MainController::class, 'artwork'])->name('artwork');
Route::get('/gallery', [MainController::class, 'gallery'])->name('gallery');
Route::get('/artwork/{id}', [MainController::class, 'artworkDetail'])->name('artwork.detail');

//User
Route::group(['namespace' => 'User', 'middleware' => 'user'], function () {

    Route::group(['namespace' => 'Cart'], function () {
        Route::post('/add-to-cart/{artwork}', [CartController::class, 'addToCart'])->name('add.to.cart');
        Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
        Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
        Route::post('/remove-cart-item', [CartController::class, 'removeCartItem'])->name('remove.cart.item');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::post('/place/order', [CartController::class, 'placeOrder'])->name('place.order');
    });

    //profile
    Route::get('/user/profile', [MainController::class, 'userProfile'])->name('user.profile');
    Route::post('/update/profile', [MainController::class, 'updateProfile'])->name('update.profile');

    //Order
    Route::get('/user/orders', [MainController::class, 'orders'])->name('view.orders');
    Route::get('user/order/{id}/details', [MainController::class, 'orderDetails'])->name('view.order.details');

});

//Admin
Route::group(['namespace' => 'Admin', 'middleware' => 'admin', 'prefix' => 'admin'], function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\MainController::class, 'dashboard'])->name('admin.dashboard');

    //Artwork
    Route::get('artwork/list', [\App\Http\Controllers\Admin\MainController::class, 'artworkList'])->name('admin.artworkList');
    Route::post('artwork/update/status', [\App\Http\Controllers\Admin\MainController::class, 'artworkUpdateStatus'])->name('admin.artwork.update.status');


    //Order
    Route::get('order/list', [\App\Http\Controllers\Admin\MainController::class, 'orderList'])->name('admin.orderList');
    Route::post('order/{id}/change/status', [\App\Http\Controllers\Admin\MainController::class, 'changeStatus'])->name('admin.order.change.status');


    //Gallery
    Route::group(['namespace' => 'Gallery', 'prefix' => 'gallery'], function () {
        Route::get('create', [GalleryController::class, 'index'])->name('admin.gallery.create');
        Route::post('store', [GalleryController::class, 'store'])->name('admin.gallery.store');
        Route::get('list', [GalleryController::class, 'list'])->name('admin.gallery.list');
        Route::get('edit/{id}', [GalleryController::class, 'edit'])->name('admin.gallery.edit');
        Route::put('update/{id}', [GalleryController::class, 'update'])->name('admin.gallery.update');
        Route::delete('delete/{id}', [GalleryController::class, 'delete'])->name('admin.gallery.delete');
    });

});


//Artist
Route::group(['namespace' => 'Artist', 'middleware' => 'artist', 'prefix' => 'artist'], function () {

    Route::get('/dashboard', [\App\Http\Controllers\Artist\MainController::class, 'dashboard'])->name('artist.dashboard');

    //Setting
    Route::get('setting/profile', [\App\Http\Controllers\Artist\MainController::class, 'settingProfile'])->name('artist.setting.profile');
    Route::post('update/profile', [\App\Http\Controllers\Artist\MainController::class, 'updateProfile'])->name('artist.update.profile');

    //Order
    Route::get('order/list', [\App\Http\Controllers\Artist\MainController::class, 'orderList'])->name('artist.orderList');


    //Artwork
    Route::group(['namespace' => 'Artwork', 'prefix' => 'artwork'], function () {
        Route::get('create', [ArtworkController::class, 'index'])->name('artist.artwork.create');
        Route::post('store', [ArtworkController::class, 'store'])->name('artist.artwork.store');
        Route::get('list', [ArtworkController::class, 'list'])->name('artist.artwork.list');
        Route::get('edit/{id}', [ArtworkController::class, 'edit'])->name('artist.artwork.edit');
        Route::put('update/{id}', [ArtworkController::class, 'update'])->name('artist.artwork.update');
        Route::delete('delete/{id}', [ArtworkController::class, 'delete'])->name('artist.artwork.delete');
    });

});
