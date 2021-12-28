<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\entryController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\userController;

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

Route::get('/', [App\Http\Controllers\entryController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\entryController::class, 'index'])->name('home');

// Route entry controller
Route::resource("entry",entryController::class)->names([
    'store' => 'entry.store'
]);

// Route comment controller
Route::resource("comment",commentController::class)->names([
    'show' => 'comment.show',
    'store' => 'comment.store'
]);

// Route resource controller
Route::resource("user",userController::class)->names([
    'show' => 'user.show',
    'store' => 'user.store'
]);

// Route follow and unfollow start
Route::get('follow/{id}', [App\Http\Controllers\userController::class, 'followUser']);
// Route follow and unfollow end
Route::get('unfollow/{id}', [App\Http\Controllers\userController::class, 'unFollowUser']);