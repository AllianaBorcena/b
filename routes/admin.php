<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductIcingController;
use App\Http\Controllers\Admin\ProductionOptionController;
use App\Http\Controllers\Admin\ProductShapeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    /** Slider Routes */
    Route::resource('slider', SliderController::class);

    /**Why Choose Us Routes */
    Route::put('why-choose-us-title-update', [WhyChooseUsController::class, 'updateTitle'])->name('why-choose-title.update');
    Route::resource('why-choose-us', WhyChooseUsController::class);


    /** Product Category Routes */
    Route::resource('category', CategoryController::class);

    /**Product Category Route */
    Route::resource('category', CategoryController::class);

    /** Sir Requirement Admin Management T-T */
    /**Product Category Route */
    Route::resource('admin-management', AdminManagementController::class);

    /**Product Make */
    Route::resource('product',ProductController::class);

    /**Product Gallery Route */
    Route::get('product-gallery/{product}', [ProductGalleryController::class, 'index'])->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryController::class);

    /**Product Icing Route */
    Route::get('product-icing/{product}', [ProductIcingController::class, 'index'])->name('product-icing.show-index');
    Route::resource('product-icing', ProductIcingController::class);
    Route::resource('product-option', ProductionOptionController::class);



});
