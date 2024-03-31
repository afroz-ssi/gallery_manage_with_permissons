<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'loginViewPage')->name('login');
    Route::post('/login', 'multiUserLogin')->name('multi_login');
    Route::get('/logout', 'AdminLogout')->name('ad_logout');
    Route::get('/userlogout', 'Logout')->name('u_logout');
});
//=================  PROTECTED ROLE

Route::middleware(['middleware' => 'admin'])->group(function () {
    Route::prefix('/admin/dashboard')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/', 'adminDashboard')->name('admin_dash');
            Route::get('/create-role-page', 'CreateRolePage')->name('create_role_pg');
            Route::post('/create-role', 'CreateRole')->name('create_role');
            Route::get('/role-details', 'RoleDetails')->name('role_details');
            Route::get('/edit-role/{id}', 'EditRole')->name('edit_role');
            Route::post('/update-role', 'UpdateRole')->name('update_role');
            Route::get('/delete-role/{id}', 'DeleteRole')->name('delete_role');

            //===== Create user ======
            Route::get('/create-user', 'CreateUserPage')->name('create_user_pg');
            Route::post('/save-user', 'SaveUser')->name('save_user');
            Route::get('/users', 'UserLists')->name('userists');
            Route::get('/delete-user/{id}', 'DeleteUser')->name('delte_user');
            Route::get('/edit-user/{id}', 'EditUser')->name('edit_user');
            Route::post('/update-user', 'UpdateUser')->name('updae_user');


            Route::get('/admin-can-act-deact-customer', 'AdminActDeactCustomer')->name('act_deact_cust');
            Route::get('/galleries-list', 'AdminGalleryLists')->name('galleries_list');
        });
    });
});



Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::prefix('/customer/dashboard')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/', 'userDashboard')->name('user_dash');
            Route::get('/create-gallery', 'CreateGalleryPage')->name('create_gallery');
            Route::post('/store-gallery', 'StoreGallery')->name('store_gallery');
            Route::get('/galleries', 'GalleryLists')->name('galleries');
            Route::get('/galleries/{id?}', 'ShowGallery')->name('showgalleries');
            Route::delete('/galleries/delete', 'DeleteGalleryImg')->name('dllt_glry_img');
            Route::get('/edit-gallery/{id}', 'EditGallery')->name('edit_gallery');
            Route::post('/update-gallery', 'UpdateGallery')->name('update_gallery');
        });
    });
});
