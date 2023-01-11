<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Event\EventController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
// Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::group(['prefix' => 'user'], function() {
// Route::middleware(['auth:sanctum'])->group(['prefix' => 'user'], function() {
    Route::get('/list', [UserController::class, 'getAllUserList'])->middleware('auth:sanctum');
    // Route::post('/create', [ProductController::class, 'create']);
    // Route::get('/update/{id}', [ProductController::class, 'getProductById']);
    // Route::post('/updated', [ProductController::class, 'updateProduct']);

    Route::post('/create', [UserController::class, 'createUser'])->middleware('auth:sanctum');
    // Route::get('/detail/{id}', 'Admin\CategoryController@getCategoryById');
    // Route::get('/update/{id}', 'Admin\CategoryController@getCategoryById');
    // Route::post('/updated', 'Admin\CategoryController@updateCategory');
    // Route::delete('/delete/{id}', 'Admin\CategoryController@deleteCategory');
});

Route::group(['prefix' => 'event'], function() {
// Route::middleware(['auth:sanctum'])->group(['prefix' => 'user'], function() {
    Route::get('/list', [EventController::class, 'getAllEventList'])->middleware('auth:sanctum');
    // Route::get('/', [EventController::class, 'getAllEvent']);
    // Route::post('/create', [ProductController::class, 'create']);
    // Route::get('/update/{id}', [ProductController::class, 'getProductById']);
    // Route::post('/updated', [ProductController::class, 'updateProduct']);
});


// test 
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
// test 
