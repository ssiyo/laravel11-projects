<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;



Route::resource("article", ArticleController::class);
Route::post("/article/like/{id}", [ArticleController::class, "like"])->name("article.like");
Route::post("/comment", [CommentController::class, 'store'])->name("comment.store");
Route::post("/interests/check", [InterestsController::class, "check"])->name("interests.check");

Route::get("/", [ArticleController::class, 'index'])->name("index");
// Route::redirect("article.index", '/');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
