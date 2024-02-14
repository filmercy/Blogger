<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('articles', ArticleController::class)
    ->only(['index', 'store','create', 'edit', 'update','destroy'])
    ->middleware(['auth', 'verified'])
    ->names([
        'articles' => 'articles.index',
        'articles.store' => 'articles.store',
        'articles.create' => 'articles.create',
        'articles.edit' => 'articles.edit',
        'articles.update' => 'articles.update',
        'articles.destroy' => 'articles.destroy',
    ]);


// Define custom route for deleting articles
Route::get('articles/{article}/delete', [ArticleController::class, 'delete'])
    ->middleware(['auth', 'verified'])
    ->name('articles.delete');

// Define custom route for publishing articles
Route::get('articles/{article}/publish', [ArticleController::class, 'publish'])
    ->middleware(['auth', 'verified'])
    ->name('articles.publish');

require __DIR__.'/auth.php';
