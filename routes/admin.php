<?php
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')
    ->middleware('is_admin');


Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');
    

Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'],function(){
    Route::get('/admin/home', 'AdminController@admin')->name('admin.home');
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/admin/password/change', 'AdminController@PasswordChange')->name('admin.password.change');
    Route::post('/admin/password/update', 'AdminController@PasswordUpdate')->name('admin.password.update');

    // Route::group(['prefix'=>'category'],function(){}); evabew lekha jabe
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@Store')->name('category.store');
        Route::get('/delete{id}', 'CategoryController@Destroy')->name('category.delete');
        Route::get('/edit{id}', 'CategoryController@edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
        
    });
    // global route
    Route::get('/get_childcategory{id}','CategoryController@GetChildcategory');

    Route::prefix('subcategory')->group(function () {
        Route::get('/', 'SubcategoryController@index')->name('subcategory.index');
        Route::post('/store', 'SubcategoryController@Store')->name('subcategory.store');
        Route::get('/delete{id}', 'SubcategoryController@Destroy')->name('subcategory.delete');
        Route::get('/edit{id}', 'SubcategoryController@edit');
        Route::post('/update', 'SubcategoryController@update')->name('subcategory.update');
        
    });

    Route::prefix('childcategory')->group(function(){
        Route::get('/', 'ChildCategoryController@index')->name('childcategory.index');
        Route::post('/store', 'ChildCategoryController@Store')->name('childcategory.store');
        Route::get('/delete{id}', 'ChildCategoryController@Destroy')->name('childcategory.delete');
        Route::get('/edit{id}', 'ChildCategoryController@edit');
        Route::post('/update', 'ChildCategoryController@update')->name('childcategory.update');
    });

    // brand routes
    Route::prefix('brand')->group(function(){
        Route::get('/', 'BrandController@index')->name('brand.index');
        Route::post('/store', 'BrandController@Store')->name('brand.store');
        Route::get('/delete{id}', 'BrandController@Destroy')->name('brand.delete');
        Route::get('/edit{id}', 'BrandController@edit');
        Route::post('/update', 'BrandController@update')->name('brand.update');
    });

    // product routes
    Route::prefix('product')->group(function(){ 
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/store', 'ProductController@Store')->name('product.store');
        Route::get('/delete{id}', 'ProductController@Destroy')->name('product.delete');
        Route::get('/edit{id}', 'ProductController@edit')->name('product.edit');
        Route::get('/not-featured/{id}', 'ProductController@notfeatured');
        Route::get('/featured/{id}', 'ProductController@featured');

        Route::get('/not-today_deal/{id}', 'ProductController@not_today_deal');
        Route::get('/today_deal/{id}', 'ProductController@today_deal');

        Route::get('/not_status/{id}', 'ProductController@not_status');
        Route::get('/status/{id}', 'ProductController@status');

    });

// warehouse route
    Route::prefix('warehouse')->group(function(){
        Route::get('/', 'WarehouseController@index')->name('warehouse.index');
        Route::post('/store', 'WarehouseController@Store')->name('warehouse.store');
        Route::get('/delete/{id}', 'WarehouseController@Destroy')->name('warehouse.delete');
        Route::get('/edit{id}', 'WarehouseController@edit');
        Route::post('/update', 'WarehouseController@update')->name('warehouse.update');
    });

    // coupon routes
    Route::prefix('coupon')->group(function(){
        Route::get('/', 'CouponController@index')->name('coupon.index');
        Route::post('/store', 'CouponController@Store')->name('coupon.store');
        Route::DELETE('/delete/{id}', 'CouponController@Destroy')->name('coupon.delete');
        Route::get('/edit/{id}', 'CouponController@edit');
        Route::post('/update', 'CouponController@update')->name('coupon.update');
    });

     // campaign routes
     Route::prefix('campaign')->group(function(){
        Route::get('/', 'CampaignController@index')->name('campaign.index');
        Route::post('/store', 'CampaignController@Store')->name('campaign.store');
        Route::get('/delete/{id}', 'CampaignController@Destroy')->name('campaign.delete');
        Route::get('/edit/{id}', 'CampaignController@edit');
        Route::post('/update', 'CampaignController@update')->name('campaign.update');
    });


    // setting

     Route::prefix('setting')->group(function(){
        //seo setting
        Route::prefix('seo')->group(function(){
            Route::get('/', 'SettingController@seo')->name('seo.setting');
            Route::post('/update/{id}', 'SettingController@seoupdate')->name('seo.setting.update');
            
        });
        //smtp setting
        Route::prefix('smtp')->group(function(){
            Route::get('/', 'SettingController@smtp')->name('smtp.setting');
            Route::post('/update/{id}', 'SettingController@smtpupdate')->name('smtp.setting.update');
            
        });

         //website setting
         Route::prefix('website')->group(function(){
            Route::get('/', 'SettingController@website')->name('website.setting');
            Route::post('/update/{id}', 'SettingController@websiteupdate')->name('website.setting.update');
            
        });
         //smtp setting
         Route::prefix('page')->group(function(){
            Route::get('/', 'PageController@index')->name('page.index');
            Route::get('/create', 'PageController@create')->name('create.page');
            Route::post('/store', 'PageController@store')->name('page.store');
            Route::get('/delete/{id}', 'PageController@destroy')->name('page.delete');
            Route::get('/edit/{id}', 'PageController@edit')->name('page.edit');
            Route::post('/update/{id}', 'PageController@update')->name('page.update');
            
        });

        // pickup_point
        Route::prefix('pickup_point')->group(function(){
            Route::get('/', 'PickupController@index')->name('pickup_point.index');    // Route::post('/store', 'PageController@store')->name('page.store');
            Route::post('/store', 'PickupController@store')->name('pickup_point.store');
            Route::DELETE('/delete/{id}', 'PickupController@Destroy')->name('pickup_point.delete');
            Route::get('/edit/{id}', 'PickupController@edit');
            Route::post('/update', 'PickupController@update')->name('pickup_point.update');
            
        });  
    });
});