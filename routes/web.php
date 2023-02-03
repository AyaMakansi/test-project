<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalization as LaravelLocalizationLaravelLocalization;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('filable',[CrudController::class,'getoffers']);

    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
        ], function(){ 
            Route::group(['prefix'=>'offers','middleware' => 'isuser','namespace' => 'Auth'],function(){
                 Route::get('create',[CrudController::class,'create']);
                 Route::post('store',[CrudController::class,'store'])->name('offers.store');
                 Route::get('edit/{offer_id}',[CrudController::class,'editoffer']);
                 Route::post('update/{offer_id}',[CrudController::class,'updateoffer'])->name('offers.update');
                 Route::get('delete/{offer_id}',[CrudController::class,'deletoffer'])->name('offers.delete');
                 Route::get('all',[CrudController::class,'getalloffers'])->name('offers.all');
                 Route::get('youtube',[CrudController::class,'getvideo']);
        });
   
 
});
