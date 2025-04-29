<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/toggle-dark-mode', function (Request $request) {
    session(['dark_mode' => !session('dark_mode', false)]);
    return back();
})->name('toggle-dark-mode');


Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.dashboard');
Route::get('/dashboard', [ProjectController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/projetos/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projetos/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');


require __DIR__.'/auth.php';
