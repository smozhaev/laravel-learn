<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
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

Route::resource('article', ArticleController::class)->middleware('auth:sanctum');

// Route::group(['prefix'=>'/article'], function(){
//     Route::get('', [ArticleController::class, 'index']);
//     Route::get('/create', [ArticleController::class, 'create']);
//     Route::get('/store', [ArticleController::class, 'store']);
//     Route::get('/action', [ArticleController::class, 'action']);
// });

//Auth
// Route::get('/auth/create', [AuthController::class, 'create']);
// Route::post('/auth/signUp', [AuthController::class, 'signUp']);
// Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
// Route::post('/auth/signIn', [AuthController::class, 'customLogin']);
// Route::prefix('/comment')->group(function () {
//     Route::get('/all', [CommentController::class, 'index'])->middleware('path');
//     Route::post('', [CommentController::class, 'store']);
//     Route::get('/edit/{id}', [CommentController::class, 'edit']);
//     Route::post('/update/{id}', [CommentController::class, 'update']);
//     Route::get('/delete/{id}', [CommentController::class, 'delete']);
//     Route::get('/accept/{id}', [CommentController::class, 'accept']);
//     Route::get('/reject/{id}', [CommentController::class, 'reject']);
// });
Route::prefix('/comment')->group(function () {
    Route::post('', [CommentController::class, 'store']);
    Route::get('/edit/{id}', [CommentController::class, 'edit']);
    Route::post('/update/{id}', [CommentController::class, 'update']);
    Route::get('/delete/{id}', [CommentController::class, 'delete']);
});
Route::post('/registr', [AuthController::class, 'registr']);
Route::get('/create', [AuthController::class, 'create']);
Route::get('/create', [AuthController::class, 'create']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/', [MainController::class, 'index']);
Route::get('/galery/{full_image}', [MainController::class, 'show']);


Route::get('/about', function () {
    return view('main/about');
});

Route::get('/contact', function () {
    $contact = [
        'name' => 'Polytech',
        'adres' => 'B.Semenofsc',
        'phone' => '8916276089',
        'email' => 'vsepelmeni@ru'
    ];
    return view('main/contact', ['contact' => $contact]);
});