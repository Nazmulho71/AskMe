<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReplyController;
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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia\Inertia::render('Dashboard');
// })->name('dashboard');

Route::get('/', [QuestionController::class, 'index'])->name('forum');

Route::group(['prefix' => 'question'], function () {
    Route::get('/', function () {
        return redirect()->route('forum');
    });

    /**
     * Questions CRUD
     */
    Route::get('/ask', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/ask', [QuestionController::class, 'store']);

    Route::get('/{question}', [QuestionController::class, 'show'])->name('question.show');

    Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::post('/{question}/edit', [QuestionController::class, 'update']);

    Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

    /**
     * Reply CRUD
     */
    Route::get('/{question}/reply', [ReplyController::class, 'create'])->name('reply.create');
    Route::post('/{question}/reply', [ReplyController::class, 'store']);
});
