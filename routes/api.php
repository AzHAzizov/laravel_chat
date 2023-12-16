<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FeedsController;
use App\Http\Controllers\PostImagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
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




Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::resource('/', UsersController::class);
        Route::get('/{user}/posts', [UsersController::class, 'post']);
        
        Route::post('/stats', [UsersController::class, 'stat']);

        Route::group(['prefix' => 'feed'], function () {
            Route::resource('/', FeedsController::class);
            Route::get('/post/list', [FeedsController::class, 'postList']);
        });


        Route::get('/{user}/toggle', [UsersController::class, 'toggle']);
        Route::get('/list', [UsersController::class, 'getList']);
    });

    Route::group(['prefix' => 'post'], function () {
        Route::resource('/{post_id}/comment', CommentsController::class);
        Route::get('/{post_id}/comment-list', [CommentsController::class, 'list']);
        Route::get('/{id}/toggle', [PostsController::class, 'toggleLike']);
        Route::resource('/', PostsController::class);
        Route::post('/{post}/repost', [PostsController::class, 'repost']);
        Route::get('list', [PostsController::class, 'getList']);
        Route::resource('images', PostImagesController::class);
    });
});
