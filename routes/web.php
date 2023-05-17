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

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin');

//create a route group "admin" and add the middleware "auth" and "verified" to it
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
    Route::resource('albums', App\Http\Controllers\AlbumController::class)->name('index', 'albums.index');
    Route::resource('clients', App\Http\Controllers\ClientController::class)->name('index', 'clients.index');
    Route::resource('media', App\Http\Controllers\MediaController::class)->name('index', 'media.index');
    Route::resource('media-categories', App\Http\Controllers\MediaCategoryController::class)->name('index', 'media-categories.index');
    Route::resource('tracks', App\Http\Controllers\TrackController::class)->name('index', 'tracks.index');
    Route::resource('pages', App\Http\Controllers\PagesController::class)->name('index', 'pages.index');
    Route::resource('posts', App\Http\Controllers\PostController::class)->name('index', 'posts.index');
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->name('index', 'projects.index');
    Route::resource('project-categories', App\Http\Controllers\ProjectController::class)->name('index', 'project-categories.index');
    Route::resource('users', App\Http\Controllers\UserController::class)->name('index', 'users.index');
});

//home
Route::get('/home', function () {
    return view('home');
})->name('home');
//ah worx
Route::get('/ahworx', function () {
    return view('worx');
})->name('ahworx');
//ahsongs
Route::get('/ahsongs', function () {
    return view('songs');
})->name('ahsongs');
//contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
//blog
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});

require __DIR__.'/auth.php';
