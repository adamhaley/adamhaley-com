<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('splash');

Route::view('/resume', 'resume')->name('resume');

//frontend routes

//home
Route::get('/home', function () {
    return view('home');
})->name('home');
//ah worx
Route::get('/worx', function () {
    return view('worx');
})->name('worx');
//ahsongs
Route::get('/songs', function () {
    return view('songs');
})->name('songs');
//contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
//blog
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

//portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

