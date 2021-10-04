<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ListContentController;
use App\Http\Controllers\ProductListController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//zwraca wszystkie kategorie
Route::get('category',[CategoryController::class,"index"]);
Route::post('category',[CategoryController::class,"store"]);

//zwraca wszystkie przedmioty
Route::get('item',[ItemController::class,"index"]);
Route::post('item',[ItemController::class,"store"]);

//zwraca wszyskie listy zakupowe
Route::get('content',[ListContentController::class,"index"])->middleware(['jwt.verify','api']);
Route::post('content',[ListContentController::class,"store"])->middleware(['jwt.verify','api']);

//zwraca zawartosc list zakupowych
Route::get('productList',[ProductListController::class,"index"])->middleware(['jwt.verify','api']);
Route::post('productList',[ProductListController::class,"store"])->middleware(['jwt.verify','api']);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
