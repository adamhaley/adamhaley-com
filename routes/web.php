<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
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



Route::get('/',[PagesController::class, 'index']);

//ah:worx page
Route::get('/worx',[PagesController::class, 'worx']);

//ah:songs page
Route::get('/songs',[PagesController::class, 'songs']);

//contact page
Route::get('/contact',[PagesController::class, 'contact']);

//blog
Route::resource('blog', PostsController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
