<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MemberController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('member', MemberController::class);
Route::post('/member/{id}',[MemberController::class,'update']);

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::resource('member', MemberController::class);
Route::resource('product', ProductController::class);
Route::post('/product/{id}',[ProductController::class,'update']);
});
