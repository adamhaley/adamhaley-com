<?php

use App\Http\Controllers\ProfileController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

//baackend admin routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('albums', App\Http\Controllers\AlbumController::class);
    Route::resource('clients', App\Http\Controllers\ClientController::class);
    Route::resource('media', App\Http\Controllers\MediaController::class);
    Route::resource('media-categories', App\Http\Controllers\MediaCategoryController::class);
    Route::resource('tracks', App\Http\Controllers\TrackController::class);
    Route::resource('pages', App\Http\Controllers\PagesController::class);
    Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
});

require __DIR__.'/auth.php';
