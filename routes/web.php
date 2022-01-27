<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

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


Auth::routes();
Route::get('/login',function(){
    return redirect()->to('/');
})->name('login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customer/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('customer.logout');


// frontend all routes here
Route::group(['namespace' => 'App\Http\Controllers\Front'],function(){
    
    Route::get('/','IndexController@index');
    Route::get('/product/details/{slug}','IndexController@Details')->name('product.details');

    Route::get('/product-quick-view{id}','IndexController@ProductQuickView');

    Route::post('/addtocart','CartController@AddToCartQV')->name('add.to.cart.quickview');
    // cart
    Route::get('/all-cart','CartController@AllCart')->name('all.cart');
    Route::get('/my-cart','CartController@MyCart')->name('cart');
    Route::get('/empty-cart','CartController@EmptyCart')->name('cart.empty');


    Route::get('/cartproduct/remove/{rowId}','CartController@RemoveProduct');
    Route::get('/cartproduct/updateqty/{rowId}/{qty}','CartController@UpdateQty');
    Route::get('/cartproduct/updatecolor/{rowId}/{color}','CartController@UpdateColor');
    Route::get('/cartproduct/updatesize/{rowId}/{size}','CartController@UpdateSize');




    // wishlist
    Route::get('/wishlist','CartController@Wishlist')->name('wishlist');
    Route::get('clear/wishlist','CartController@ClearWishlist')->name('clear.wishlist');
    Route::get('/add/wishlist/{id}','CartController@addwishlist')->name('add.wishlist');
    Route::get('/wishlistproduct/delete/{id}','CartController@WishlistProductDelete')->name('wishlistproduct.delete');

    // review
    Route::post('/store/review','ReviewController@Store')->name('review.store');

    // category wise products
    Route::get('/category/product/{id}','IndexController@CategoryWiseProduct')->name('categorywise.product');
    Route::get('/subcategory/product/{id}','IndexController@SubCategoryWiseProduct')->name('subcategorywise.product');
    Route::get('/childcategory/product/{id}','IndexController@ChildCategoryWiseProduct')->name('childcategorywise.product');
    Route::get('/brandwise/product/{id}','IndexController@BrandWiseProduct')->name('brandwise.product');


});

// Route::get('/cart',function(){
//     return response()->json(Cart::content());
// });


