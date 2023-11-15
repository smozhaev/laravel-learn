<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
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

Route::get('article/show', [ArticleController::class, 'index']);
Route::get('/signup', [AuthController::class, 'create']);
Route::post('/auth/login', [AuthController::class, 'singUp']);
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