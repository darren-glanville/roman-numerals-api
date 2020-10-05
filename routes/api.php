<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NumeralsController;

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

// convert
Route::get('/numerals/add/{id}', [NumeralsController::class, 'convertInteger']);

// list all
Route::get('/numerals', [NumeralsController::class, 'listAll']);

// list top 10
Route::get('/numerals/top10', [NumeralsController::class, 'listTop10']);
