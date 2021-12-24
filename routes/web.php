<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\entryController;

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