<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:api')->group(function(){
        Route::group(['middleware' => ['role:admin']], function () {
            Route::apiResource('roles', RoleController::class)->except('create','edit');
        });
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('forgotPassword', 'forgotPassword');
        Route::post('resetPassword', 'resetPassword')->name('password.reset');
        Route::group(['controller' => CategoryController::class, 'prefix'=>'categories' ], function () {
            Route::get('', 'index')->middleware(['permission:view category']);
            Route::post('', 'store')->middleware(['permission:add category']);
            Route::get('/{category}', 'show')->middleware(['permission:view category']);
            Route::put('/{category}', 'update')->middleware(['permission:edit category']);
            Route::delete('/{category}', 'destroy')->middleware(['permission:delete category']);
        });
        Route::group(['controller' => CommentController::class,'prefix'=>'comments'], function () {
            Route::post('', 'store')->middleware(['permission:add comment']);
            Route::get('/{comment}', 'show')->middleware(['permission:view comment']);
            Route::put('/{comment}', 'update')->middleware(['permission:edit comments|edit comment']);
            Route::delete('/{comment}', 'destroy')->middleware(['permission:delete comments|delete comment']);
        });
        Route::group(['controller' => TagController::class ,'prefix'=>'tags'], function () {
            Route::get('', 'index')->middleware(['permission:view tag']);
            Route::post('', 'store')->middleware(['permission:add tag']);
            Route::get('/{tag}', 'show')->middleware(['permission:view tag']);
            Route::put('/{tag}', 'update')->middleware(['permission:edit tag']);
            Route::delete('/{tag}', 'destroy')->middleware(['permission:delete tag']);
        });
        Route::group(['controller' => ArticleController::class, 'prefix' => 'articles'], function () {
            Route::get('', 'index')->middleware(['permission:view articles']);
            Route::post('', 'store')->middleware(['permission:add article']);
            Route::get('/{article}', 'show')->middleware(['permission:view articles']);
            Route::put('/{article}', 'update')->middleware(['permission:edit My article|edit All article']);
            Route::delete('/{article}', 'destroy')->middleware(['permission:delete My article|delete All article']);
        });
        Route::group(['controller' => UserController::class,'prefix' => 'users'], function () {
            Route::get('', 'index')->middleware(['permission:view users']);
            Route::get('/{user}', 'show')->middleware(['permission:view user']);
            Route::put('/{user}', 'update')->middleware(['permission:edit users|edit user']);
            Route::delete('/{user}', 'destroy')->middleware(['permission:delete users|delete user']);
            Route::put('/pass/{user}', 'update_password')->middleware(['permission:edit users|edit user']);
        });
    });
});
