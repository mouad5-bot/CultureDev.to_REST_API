<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticleController ;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

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


// endpoints for authentication ['login', 'register', 'logout', 'refresh']
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:api')->group(function(){
        Route::group(['middleware' => ['role:admin']], function () {
            Route::apiResource('roles', RoleController::class)->except('create','edit');
        });
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::group(['controller' => CategoryController::class, 'prefix'=>'categories' ], function () {
            Route::get('', 'index')->middleware(['permission:view category']);
            Route::post('', 'store')->middleware(['permission:add category']);
            Route::get('/{category}', 'show')->middleware(['permission:view category']);
            Route::put('/{category}', 'update')->middleware(['permission:edit category']);
            Route::delete('/{category}', 'destroy')->middleware(['permission:delete category']);
        });
        Route::group(['controller' => CommentController::class,'prefix'=>'comment'], function () {
            Route::get('','index')->middleware(['permission:view comment']);
            Route::post('', 'store')->middleware(['permission:add comment']);
            Route::get('/{comment}', 'show')->middleware(['permission:view comment']);
            Route::put('/{comment}', 'update')->middleware(['permission:edit comment']);
            Route::delete('/{comment}', 'destroy')->middleware(['permission:delete comment']);
        });
        Route::group(['controller' => TagController::class ,'prefix'=>'tags'], function () {
            Route::get('', 'index')->middleware(['permission:view tag']);
            Route::post('', 'store')->middleware(['permission:add tag']);
            Route::get('/{tag}', 'show')->middleware(['permission:view tag']);
            Route::put('/{tag}', 'update')->middleware(['permission:edit tag']);
            Route::delete('/{tag}', 'destroy')->middleware(['permission:delete tag']);
        });
        Route::group(['controller' => ArticleController::class, 'prefix' => 'articles'], function () {
            Route::get('', 'index')->middleware(['permission:view article']);
            Route::post('', 'store')->middleware(['permission:add article']);
            Route::get('/{article}', 'show')->middleware(['permission:view article']);
            Route::put('/{article}', 'update')->middleware(['permission:edit my article|edit all article']);
            Route::delete('/{article}', 'destroy')->middleware(['permission:delete My article | delete All article']);
        });
        Route::group(['controller' => UserController::class,'prefix' => 'users'], function () {
            Route::get('', 'index')->middleware(['permission:view user']);
            Route::post('', 'store')->middleware(['permission:add user']);
            Route::get('/{user}', 'show')->middleware(['permission:view user']);
            Route::put('/{user}', 'update')->middleware(['permission:edit user']);
            Route::delete('/{user}', 'destroy')->middleware(['permission:delete user']);
            Route::put('user/pass/{user}', [UserController::class, 'update_password'])->middleware(['permission:edit user']);
        });
    });
});
// Route::apiResource('categories', CategoryController::class);

// Route::apiResource('articles', ArticleController::class)->except('create','edit');


// endpoints for user ['get all users', 'get specific user', 'update information's' , 'delete account']
// second line (37) : this endpoint for update password
// Route::apiResource('user', UserController::class)->except(['store']);


// endpoints for comment ['add comment', 'get comments for specific article', 'update' , 'delete']
// Route::apiResource('comment', CommentController::class)->except(['index']);
// Tags
// Route::resource('tags', TagController::class);
// Route::get('tags', [TagController::class, 'index']);
// Route::get('/tags/{tag}', [TagController::class, 'show']);
// Route::post('/tags', [TagController::class, 'store']);
// Route::put('/tags/{tag}', [TagController::class, 'update']);
// Route::delete('/tags/{tag}', [TagController::class, 'delete']);


// 

