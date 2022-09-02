<?php

use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('posts', PostController::class);

Route::get('/posts',[PostController::class, 'index'])->name('posts.index');
Route::post('/posts',[PostController::class, 'store'])->name('posts.store');
Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
// Route::get('/posts/edit/{id}',[PostController::class, 'edit'])->name('posts.edit');
// Route::put('/posts/update/{id}',[PostController::class, 'update'])->name('posts.update');