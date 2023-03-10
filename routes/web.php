<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::get('/blogs/{id}', [BlogController::class, 'index']);
Route::post('/blogs/update/{id}', [BlogController::class, 'update']);
Route::delete('/blogs/delete/{id}', [BlogController::class, 'destroy']);

