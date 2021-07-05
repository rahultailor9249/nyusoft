<?php

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
Route::get('form',function () {
   return view('welcome');
});
Route::post('form-submit',[\App\Http\Controllers\companyController::class,'store']);
Route::get('/',[\App\Http\Controllers\companyController::class,'companyList'],function (){
    return view('welcome');
});
//Route::get('/',[\App\Http\Controllers\companyController::class,'allCompanyChart']);
Route::get('edit/{companyId}',[\App\Http\Controllers\companyController::class,'getCompanyData']);

//Route::get('/', function () {
//    return view('welcome');
//});
