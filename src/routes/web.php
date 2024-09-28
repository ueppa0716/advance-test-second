<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

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

Route::get('/', [ItemController::class, 'item']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);

Route::middleware(['guest'])->group(function () {
    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mylist', [ItemController::class, 'mylist']);

    Route::get('/mypage', [UserController::class, 'mypage']);
    Route::post('/mypage/profile', [UserController::class, 'profile']);

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase']);
    Route::post('/purchase/address/{item_id}', [PurchaseController::class, 'address']);
    Route::post('/purchase/{item_id}/complete', [PurchaseController::class, 'complete']);

    Route::post('/sell', [SellController::class, 'sell']);

    Route::post('/item/{item_id}/like', [LikeController::class, 'like']);

    Route::get('/comment/{item_id}', [CommentController::class, 'comment']);
    Route::post('/comment/update', [CommentController::class, 'update']);

    Route::get('/profile', function () {
        // 確認済みのユーザーのみがこのルートにアクセス可能
    });
});
