<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\BackendController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;

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

Route::name('public.')->as('public.')->namespace('App\Http\Controllers\Public')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/attendance', [HomeController::class, 'attendance'])->name('sign.in');
    Route::get('/attendance/{employee}', [HomeController::class, 'show']);
});

Route::get('/register', [LoginController::class , 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class , 'register'])->name('register.post');
Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class , 'login'])->name('login.post');
Route::group(['middleware' => 'auth'], function () {
    Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [BackendController::class, 'index'])->name('home.dashboard');
    Route::get('/profile', [BackendController::class, 'profile'])->name('profile.index');
    Route::get('/users', [BackendController::class, 'users'])->name('users');
    Route::get('/panel/articles', [ArticleController::class, 'articles'])->name('panel.news.articles');
    Route::get('/panel/news/create', [ArticleController::class, 'create'])->name('panel.news.articles.create');
    Route::post('/panel/news/create', [ArticleController::class, 'store']);
    Route::get('/panel/news/update/{article}', [ArticleController::class, 'edit'])->name('panel.news.articles.update');
    Route::post('/panel/news/update/{article}', [ArticleController::class, 'update']);
    Route::post('/panel/news/delete/{article}', [ArticleController::class, 'destroy'])->name('panel.news.articles.delete');


    Route::get('/panel/categories', [CategoryController::class, 'index'])->name('panel.categories');
    Route::get('/panel/category/create', [CategoryController::class, 'create'])->name('panel.category.create');
    Route::post('/panel/category/create', [CategoryController::class, 'store']);
    Route::get('/panel/category/update/{category}', [CategoryController::class, 'edit'])->name('panel.category.update');
    Route::post('/panel/category/update/{category}', [CategoryController::class, 'update']);
    Route::post('/panel/category/delete/{category}', [CategoryController::class, 'destroy'])->name('panel.category.delete');
    Route::post('/panel/category/status-change/{category}', [CategoryController::class, 'changeStatus'])->name('panel.category.change_status');
    
    Route::get('/panel/my-articles', [ArticleController::class, 'myArticles'])->name('panel.user.articles');
    Route::get('/panel/comments', [ArticleController::class, 'comments'])->name('panel.news.comments');
});
