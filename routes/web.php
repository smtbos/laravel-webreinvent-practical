<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('todos')->name('todos.')->group(function () {
        Route::get('/', [TodoController::class, 'index'])->name('index');
        Route::get('/datatable', [TodoController::class, 'datatable'])->name('datatable');
        Route::post('/', [TodoController::class, 'store'])->name('store');
        Route::put('/{todo}', [TodoController::class, 'update'])->name('update');
        Route::patch('/{todo}/done', [TodoController::class, 'updateDone'])->name('update.done');
        Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
