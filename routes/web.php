<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\TasklistController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ImageController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::resource('tasklist', TasklistController::class);

Route::get('tasklist/{task_id}/checklist', [ChecklistController::class, 'index'])->name('checklist.index');
Route::get('tasklist/{task_id}/checklist/create', [ChecklistController::class, 'create'])->name('checklist.create');
Route::post('tasklist/{task_id}/checklist', [ChecklistController::class, 'store'])->name('checklist.store');
Route::get('tasklist/{task_id}/checklist/{checklist_id}/edit', [ChecklistController::class, 'edit'])->name('checklist.edit');
Route::put('tasklist/{task_id}/checklist/{checklist_id}', [ChecklistController::class, 'update'])->name('checklist.update');
Route::delete('tasklist/{task_id}/checklist/{checklist_id}', [ChecklistController::class, 'destroy'])->name('checklist.destroy');

Route::get('tasklist/{task_id}/images', [ImageController::class, 'index'])->name('images.index');
Route::get('tasklist/{task_id}/images/create', [ImageController::class, 'create'])->name('images.create');
Route::post('tasklist/{task_id}/images', [ImageController::class, 'store'])->name('images.store');
Route::delete('tasklist/{task_id}/images/{image_id}', [ImageController::class, 'destroy'])->name('images.destroy');