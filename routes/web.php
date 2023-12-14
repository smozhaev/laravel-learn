<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;


Route::resource('article', ArticleController::class)->middleware('auth:sanctum');

Route::resource('user', UserController::class)->middleware('auth:sanctum');

Route::prefix('/comment')->middleware('auth:sanctum')->group(function () {
    Route::post('', [CommentController::class, 'store']);
    Route::get('/edit/{id}', [CommentController::class, 'edit']);
    Route::post('/update/{id}', [CommentController::class, 'update']);
    Route::get('/delete/{id}', [CommentController::class, 'delete']);
});

Route::prefix('/moderate')->middleware('can:moderator')->group(function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::patch('/approve/{comment}/', [CommentController::class, 'approve']);
    Route::patch('/disapprove/{comment}/', [CommentController::class, 'disapprove']);
});

Route::post('/registr', [AuthController::class, 'registr']);
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