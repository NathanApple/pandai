<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PointProductController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TransactionController;
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
Route::prefix('/question')->group(function(){
    Route::get('/', [QuestionController::class,'index'])->name('question');
    Route::get('/view/{id}', [QuestionController::class,'view'])->name('question.view');
    Route::post('/view/{id}/answer', [QuestionController::class,'answer'])->name('question.view.answer');
    Route::post('/storeQuestion', [QuestionController::class,'store']);
});

Route::prefix('product')->group(function(){
    Route::get('/', [PointProductController::class, 'index'])->name('product');
    Route::get('/history', [PointProductController::class, 'history'])->name('product.history');
    Route::post('/purchase', [PointProductController::class, 'purchase'])->name('product.purchase');
    Route::get('/status/{orderid}', [PointProductController::class, 'process'])->name('product.process');
});

Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');

Route::get('/', [IndexController::class,'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
