<?php

use App\Http\Controllers\Admin\admin_ctrl;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\Auth\auth_ctrl;
use App\Http\Controllers\User\user_ctr;
use App\Http\Middleware\admin_MDW;
use Illuminate\Support\Facades\Route;

//error page 
    Route::fallback(function () {
        return view('user_pages/error_page');
    });
//======================================================================================================
//user pages
    Route::get('/', [user_ctr::class, 'index']);
    Route::get('/Menu', [user_ctr::class, 'menu_page']);
    Route::get('/Login', [auth_ctrl::class, 'login_page']);
    Route::get('/Register', [auth_ctrl::class, 'register_page']);
    Route::post('/signup', [auth_ctrl::class, 'signup']);
    Route::post('/signin', [auth_ctrl::class, 'signin']);
    Route::get('/logout', [auth_ctrl::class, 'logout'])->name('logout');
    Route::get('/Dish/Details/{encrypted_id}', [user_ctr::class, 'dish_details']);
    Route::post('/add/product/to/cart/{id}', [user_ctr::class, 'addcart']);
    Route::get('/CheckOut', [user_ctr::class, 'checkout_page']);

    Route::post('/increment-cart-item', [user_ctr::class, 'increment'])->name('cart.increment');
    Route::post('/decrement-cart-item', [user_ctr::class, 'decrement'])->name('cart.decrement');
    Route::post('/update-cart-item-quantity', [user_ctr::class, 'updateQuantity'])->name('cart.updateQuantity');
    Route::post('/Order/Now', [user_ctr::class, 'checkout_function']);
    Route::post('/check-coupon', [user_ctr::class, 'check'])->name('coupon.check');
    Route::get('/Delete/Item/{encrypted_id}', [user_ctr::class, 'delete_item_from_cart']);
    Route::get('/Delete/compo/Item/{encrypted_compo_id}', [user_ctr::class, 'delete_compo_from_cart']);

    Route::get('/ContactUs', [user_ctr::class, 'contact_us_form']);
    Route::post('/contact/form', [user_ctr::class, 'sendEmail']);
    Route::get('/compo', [user_ctr::class, 'compo_page']);
    Route::post('/add/compo/to/cart/{id}', [user_ctr::class, 'addCompoToCart']);
    Route::get('/Offer', [user_ctr::class, 'offer']);
    Route::get('/Catreing', [user_ctr::class, 'catreing']);
    Route::get('/sendsms', [user_ctr::class, 'sendsms']);
//==============================================================================================================================
//admin pages
    Route::group(['middleware' => ['isAdmin'], 'prefix' => 'admin'], function () {
        Route::get('/dashboard', [admin_ctrl::class, 'index']);
        Route::get('/add/new/item', [admin_ctrl::class, 'add_new_item']);
        Route::get('/Main/Categories', [admin_ctrl::class, 'main_categories']);
        Route::get('/dishes/data', [admin_ctrl::class, 'dishes_data']);
        Route::post('/addnewcategory', [admin_ctrl::class, 'add_new_category']);
        Route::post('/add/new/dish', [admin_ctrl::class, 'add_new_dish']);
        Route::get('/Shipping/Data', [admin_ctrl::class, 'shipping_page']);
        Route::post('/addnewshippingdata', [admin_ctrl::class, 'addnewshippingdata']);
        Route::get('/Coupons/Data', [admin_ctrl::class, 'coupon_data']);
        Route::delete('/coupons/multi-delete', [admin_ctrl::class, 'multiDelete'])->name('coupons.multiDelete');
        Route::delete('/coupons/multi-delete', [admin_ctrl::class, 'multiDelete'])->name('coupons.multiDelete');
        Route::post('/coupons/generate', [admin_ctrl::class, 'generateCoupon'])->name('coupons.generate');
        Route::get('/export-pdf', [PdfController::class, 'export'])->name('pdf.export');
        Route::get('/Orders/Data', [admin_ctrl::class, 'Orders_data']);
        Route::get('/Order/Details/{encrypted_id}', [admin_ctrl::class, 'order_details']);
        Route::post('/change/status', [admin_ctrl::class, 'change_order_staus']);
        Route::get('/delete/order/{encrypted_id}', [admin_ctrl::class, 'delete_order'])->name('admin.order.delete');
        Route::get('/Users/Data', [admin_ctrl::class, 'UsersList']);
        Route::get('/delete/user/{encrypted_id}', [admin_ctrl::class, 'delete_user'])->name('admin.user.delete');
        Route::get('/delete/dish/{encrypted_id}', [admin_ctrl::class, 'delete_dish'])->name('admin.dish.delete');
        Route::get('/edite/dish/data/{encrypted_id}', [admin_ctrl::class, 'edite_dish'])->name('admin.dish.edite');
        Route::post('/edite/dish', [admin_ctrl::class, 'edite_dish_fun']);
        Route::get('/delete/category/{encrypted_id}', [admin_ctrl::class, 'delete_category'])->name('admin.category.delete');
        Route::post('/edite/category', [admin_ctrl::class, 'editeCategory']);
        Route::get('/Compo', [admin_ctrl::class, 'compo_page']);
        Route::get('/add/new/compo', [admin_ctrl::class, 'addNewCompoForm']);
        Route::get('/get-pieces-data', [admin_ctrl::class, 'getPiecesData']);
        Route::post('/add/compo', [admin_ctrl::class, 'saveCompo']);
        Route::get('/Offers', [admin_ctrl::class, 'offer']);
        Route::post('/addnewoffer', [admin_ctrl::class, 'add_new_offers']);
        Route::post('/edite/offer', [admin_ctrl::class, 'edite_offers']);
        Route::get('/delete/offer/{encrypted_id}', [admin_ctrl::class, 'delete_offers'])->name('admin.category.delete');
        Route::get('/add/New/Catering', [admin_ctrl::class, 'addNewCatering']);
        Route::post('/add/catering', [admin_ctrl::class, 'addcatering']);
        Route::get('/Catering', [admin_ctrl::class, 'catering_page']);
        Route::get('/delete/catering/{encrypted_id}', [admin_ctrl::class, 'delete_catering']);
        Route::get('/edite/catering/data/{encrypted_id}', [admin_ctrl::class, 'edite_catering']);
        Route::get('/delet_image/{id}', [admin_ctrl::class, 'delet_image']);
        Route::post('/editCatering', [admin_ctrl::class, 'editCatering']);
        Route::get('/delete/compo/{encrypted_id}', [admin_ctrl::class, 'deleteCompo']);
        Route::get('/delete/pices/info/{encrypted_id}', [admin_ctrl::class, 'delete__pices_item']);
        Route::get('/delete/city/{encrypted_id}', [admin_ctrl::class, 'delete_city']);
    });
//==============================================================================================================================
