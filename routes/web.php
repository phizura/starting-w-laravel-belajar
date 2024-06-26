<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;

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

// using clousure
Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
        'active' => 'Home',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'active' => 'About',
        'name' => 'Satrio Adi Prakoso',
        'email' => 'satrioapra@phi.com',
    ]);
});


// using controller
Route::get('/posts', [PostController::class, "index"]);

// ':slug' digunakan supaya yang diambil indetifier nya adalah slug karena kalo tidak di berikan maka yang diambil adalah id
Route::get('posts/{post:slug}', [PostController::class, 'show']);



Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

Route::get('/authors/{author:username}', [UserController::class, 'show']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);







Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

    Route::get('/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
    Route::resource('/posts', DashboardPostController::class)->parameters(['post' => 'slug'])->middleware('auth');

    Route::resource('/categories', AdminCategoryController::class)->except(['show', 'create'])->parameters(['category' => 'slug'])->middleware('admin');

    Route::get('/users', [AdminUserController::class, 'index'])->middleware('admin');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->middleware('admin');
});
