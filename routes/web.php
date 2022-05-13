<?php

use App\Http\Controllers\ShowsController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shows', [ShowsController::class, 'index']);
Route::get('/shows/create', [ShowsController::class, 'create']);
Route::post('/shows/save', [ShowsController::class, 'store']);
