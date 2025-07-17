<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cats = Category::all();
    $posts = [];
    foreach ($cats as $cat){
        if(count($cat->posts()->get()) == 0) continue;
        $posts[$cat->name] = $cat->posts()->where('status','done')->limit(4)->get();
    }
    return view('welcome',compact(['posts']));
})->name('home');

Route::post('coment/{id}', [CommentController::class,'store'])->name('comments.store');

Route::group(['prefix' => '/post'],function(){
    Route::get('/',[PostController::class,'index'])->name('post.index');
    Route::get('/show/{id}',[PostController::class,'show'])->name('post.show');
});
Route::group(['prefix' => '/cat'],function(){
    Route::get('/',function(){})->name('cat.index');
    Route::get('/show/{id}',[CategoryController::class,'show'])->name('cat.show');
});

Auth::routes();

// Route::get('/home', function(){redirect('filament.panel.pages.dashboard');})->name('dashboard');
