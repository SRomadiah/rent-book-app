<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [PublicController::class, 'index']);

Route::middleware('only_guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticating']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProcess']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [UserController::class, 'profile'])->middleware('only_client');
});
// Page yang hanya boleh di akses oleh admin 
Route::middleware('only_admin')->group(function () {
    // dashboard admin
    Route::get('dashboard', [DashboardController::class, 'index']);
    // Route::get('dashboard', [DashboardController::class, 'rentLogs']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('registered-user', [UserController::class, 'registeredUser']);
    Route::get('user-detail/{slug}', [UserController::class, 'show']);
    Route::get('user-approve/{slug}', [UserController::class, 'approve']);
    Route::get('user-blacklist/{slug}', [UserController::class, 'delete']);
    Route::get('user-destroy/{slug}', [UserController::class, 'destroy']);
    Route::get('user-blacklisted', [UserController::class, 'blacklistedUser']);
    Route::get('user-restore/{slug}', [UserController::class, 'restore']);
    // Books
    Route::get('books', [BookController::class, 'index']);
    Route::get('book-add', [BookController::class, 'add']);
    Route::post('book-add', [BookController::class, 'store']);
    Route::get('book-edit/{slug}', [BookController::class, 'edit']);
    Route::post('book-edit/{slug}', [BookController::class, 'update']);
    Route::get('book-delete/{slug}', [BookController::class, 'delete']);
    Route::get('book-destroy/{slug}', [BookController::class, 'destroy']);
    Route::get('book-deleted', [BookController::class, 'deletedBook']);
    Route::get('book-restore/{slug}', [BookController::class, 'restore']);
    // Categories
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::get('category-add', [CategoriesController::class, 'add']);
    Route::post('category-add', [CategoriesController::class, 'store']);
    Route::get('category-edit/{slug}', [CategoriesController::class, 'edit']);
    Route::put('category-edit/{slug}', [CategoriesController::class, 'update']);
    Route::get('category-delete/{slug}', [CategoriesController::class, 'delete']);
    Route::get('category-destroy/{slug}', [CategoriesController::class, 'destroy']);
    Route::get('category-deleted', [CategoriesController::class, 'deletedCategory']);
    Route::get('category-restore/{slug}', [CategoriesController::class, 'restore']);

    Route::get('book-rent', [BookRentController::class, 'index']);
    Route::post('book-rent', [BookRentController::class, 'store']);

    Route::get('rentlog', [RentLogController::class, 'index']);
    // fitur mengembalikan buku
    Route::get('return-book', [BookRentController::class, 'returnBook']);
    Route::post('return-book', [BookRentController::class, 'saveReturnBook']);
});
