<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\Auth;
use App\Http\Middleware\Author;
use App\Http\Middleware\Guest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::all();
    $uncategorized = Post::where('category_id', null)->where('status', 'accepted')->limit(4)->get();

    $slider_posts = Post::limit(4)->get();

    $posts = [];
    if($uncategorized->count() > 0) {
        $posts['Uncategorized'] = [
            'posts' => $uncategorized,
            'id' => null
        ];
    }

    foreach ($categories as $category) {
        $categoryPosts = $category->posts()->where('status', 'accepted')->limit(4)->get();
        if ($categoryPosts->count() > 0) {
            $posts[$category->name] = [
                'posts' => $categoryPosts,
                'id' => $category->id
            ];
        }
    }

    return view('welcome', compact('posts', 'slider_posts'));
})->name('home');

Route::get('/category', [CategoryController::class, 'showUncategorized'])->name('uncategorized.show');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');


Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::middleware([Guest::class])->prefix('/auth')->group(function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware([Auth::class])->prefix('dashboard')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('comment/{post}', [CommentController::class, 'store']);

    Route::get('/comments', [CommentController::class, 'index'])->name('dashboard.comments');

    Route::get('/comment/{comment}', [CommentController::class, 'edit'])->name('dashboard.edit-comment');

    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('dashboard.comments.update');

    Route::delete('/comments/{comment}', [CommentController::class, 'delete'])->name('dashboard.comments.delete');

    Route::post('/comments', [CommentController::class, 'store'])->name('dashboard.comments.store');

    Route::middleware([Author::class])->group(function() {
        Route::get('/posts/comments', [PostCommentController::class, 'index'])->name('dashboard.author.comments');

        Route::get('/posts/comments/{comment}', [PostCommentController::class, 'edit'])->name('dashboard.posts.comments.edit');

        Route::put('/posts/comments/{comment}', [PostCommentController::class, 'update'])->name('dashboard.posts.comments.update');


        Route::get('/posts', [PostController::class, 'indexAuthor'])->name('dashboard.posts');

        Route::get('/posts/new', [PostController::class, 'create'])->name('dashboard.create-post');

        Route::get('/posts/{post}', [PostController::class, 'edit'])->name('dashboard.edit-post');

        Route::post('/posts', [PostController::class, 'store'])->name('dashboard.posts.store');

        Route::put('/posts/{post}', [PostController::class, 'update'])->name('dashboard.posts.update');

        Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('dashboard.posts.delete');

    });
});


