<?php

use App\Http\Controllers\NoteController;
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
Route::patch('/notes/{note}', [NoteController::class, 'update'])->middleware(['auth']);

Route::get('/notes/{note:id}/show', [NoteController::class, 'show'])
    ->middleware(['auth'])->name('notes.show');

Route::get('/notes/{note:id}/edit', [NoteController::class, 'edit'])
    ->middleware(['auth'])->name('notes.edit');

Route::get('/notes', function (){
    return view('notes.index');
})->name('notes.index')->middleware(['auth']);

Route::post('/notes', [NoteController::class, 'store'])
    ->middleware(['auth'])
;

Route::delete('/notes/{note}', [NoteController::class, 'destroy'])
    ->middleware(['auth'])
;

Route::patch('/notes/{note}', [NoteController::class, 'fav'])
    ->middleware(['auth']);

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
});

require __DIR__.'/auth.php';
