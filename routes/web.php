<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
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

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('forum');
    } else {
        return view('landing');
    }
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/{user}', [DashboardController::class, 'index'])->name('dashboard');

/**
 * Questions CRUD
 */
Route::group(['prefix' => 'question'], function () {
    Route::get('/', [QuestionController::class, 'index'])->name('forum');

    Route::get('/ask', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/ask', [QuestionController::class, 'store']);

    Route::get('/{question}', [QuestionController::class, 'show'])->name('question.show');

    Route::get('/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/{question}/edit', [QuestionController::class, 'update']);

    Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

    /**
     * Reply CRUD
     */
    Route::group(['prefix' => '{question}/reply'], function ($question) {
        Route::get('/', [ReplyController::class, 'create'])->name('reply.create');
        Route::post('/', [ReplyController::class, 'store']);

        Route::get('/{reply}/edit', [ReplyController::class, 'edit'])->name('reply.edit');
        Route::put('/{reply}/edit', [ReplyController::class, 'update']);

        Route::delete('/{reply}/delete', [ReplyController::class, 'destroy'])->name('reply.destroy');
    });
});

/**
 * Like & Unlike
 */
Route::post('/reply/{reply}/like', [LikeController::class, 'likeIt'])->name('like');
Route::delete('/reply/{reply}/unlike', [LikeController::class, 'unlikeIt'])->name('unlike');

/**
 * Categories
 */
Route::group(['prefix' => 'category'], function () {
    Route::get('/{category}', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/{category}/ask', [CategoryController::class, 'createQue'])->name('category.que.create');
});
