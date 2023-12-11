<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('queryLogger')->group(function(){
    Route::controller(AuthorController::class)->group(function () {
        Route::prefix('authors')->group(function () {
            Route::get('/', 'index')->name('getAuthors');
            Route::get('/posts', 'authorsWithPosts')->name('getAuthorsWithPosts');
            Route::post('/', 'create')->name('createAuthor');
            Route::get('/{id}', 'show')->name('getAuthor');
            Route::get('/{author}/posts', 'authorWithPosts')->name('getAuthorWithPosts');
            Route::put('/{author}', 'update')->name('updateAuthor');
            Route::delete('/{author}', 'delete')->name('deleteAuthor');
        });
    });


    Route::controller(PostController::class)->group(function () {
        Route::prefix('posts')->group(function () {
            Route::get('/', 'index')->name('getPosts');
            Route::post('/', 'create')->name('createPost');
            Route::get('/{id}', 'show')->name('getPost');
            Route::put('/{post}', 'update')->name('updatePost');
            Route::delete('/{post}', 'delete')->name('deletePost');
        });
    });
});
