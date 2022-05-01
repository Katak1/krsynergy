<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/','WelcomeController@index')->name('welcome');

Route::group(['namespace' => 'Post'], function(){
    Route::get('/post','IndexController')->name('posts.index');
    Route::get('/post/show/{id}','ShowController')->name('posts.Show');
    Route::delete('/post/show/{id}','ShowController')->name('posts.showdelete');
    Route::patch('/post/show/{id}','ShowController')->name('posts.showpatch');
    Route::get('/fetch-post', 'FetchController')->name('posts.fetch');
    Route::post('/post', 'StoreController')->name('posts.store');
    Route::get('/post/{id}', 'EditController')->name('posts.edit');
    Route::post('/post/search', 'SearchController')->name('posts.search');
    Route::patch('/post/{id}', 'UpdateController')->name('posts.update');
    Route::delete('/post/{id}', 'DestroyController')->name('posts.destroy');
    Route::group(['namespace' => 'Comment'],function(){
        Route::post('post/show/{id}/comment', 'StoreController')->name('comm.store');
        Route::delete('post/show/{id}/comment/{comid}', 'DestroyController')->name('comm.delete');

    });
});




Route::group(['namespace'=>'Admin', 'prefix'=>'admin', 'middleware'=>'admin'], function(){
    Route::get('','AdminController@index')->name('admin.index');
    Route::group(['namespace'=>'Post'], function(){
        Route::get('/post','IndexController')->name('admin.post.index');
        Route::get('/fetch-post', 'FetchController')->name('admin.post.fetch');
        Route::post('/post', 'StoreController')->name('admin.post.store');
        Route::get('/post/{id}', 'EditController')->name('admin.post.edit');
        Route::patch('/post/{id}', 'UpdateController')->name('admin.post.update');
        Route::delete('/post/{id}', 'DestroyController')->name('admin.post.destroy');
    });
    Route::group(['namespace'=>'Category'], function(){
       Route::get('/category', 'IndexController')->name('admin.category.index');
       Route::get('/fetch-category', 'FetchController')->name('admin.category.fetch');
       Route::post('/category', 'StoreController')->name('admin.category.store');
       Route::get('/category/{id}', 'EditController')->name('admin.category.edit');
       Route::patch('/category/{id}', 'UpdateController')->name('admin.category.update');
       Route::delete('/category/{id}', 'DestroyController')->name('admin.category.destroy');
    });
});




Auth::routes(['verify' => true]);
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


//Route::patch('/account/{id}', 'UpdateController@update')->name('user.update');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/account');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/account', [App\Http\Controllers\HomeController::class, 'index'])->name('account');
Route::patch('/account/{id}', 'UpdateController@update')->name('user.update');

