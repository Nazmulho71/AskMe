<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/', [QuestionController::class, 'index'])->name('forum');

Route::get('/question/create', [QuestionController::class, 'create'])->name('question.create');
Route::post('/question/create', [QuestionController::class, 'store']);

Route::get('/question/{question:slug}', [QuestionController::class, 'show'])->name('question.show');

Route::get('/question/{question:slug}/edit', [QuestionController::class, 'edit'])->name('question.edit');
Route::post('/question/{question:slug}/edit', [QuestionController::class, 'update']);

Route::delete('/question/{question:slug}', [QuestionController::class, 'destroy'])->name('question.destroy');
