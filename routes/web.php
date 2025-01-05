<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\VisitController;
use App\Models\BookCopy;
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

// For guest page
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'authenticate'])->name('authenticate');
});


// For authenticated user page
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'role:staff|developer'], function () {
        // Books
        Route::get('/books', [BookController::class, 'index'])->name('book.index');
        Route::post('/books', [BookController::class, 'store'])->name('book.store');
        Route::put('/books/{book}/update', [BookController::class, 'update'])->name('book.update');
        Route::get('/books/create', [BookController::class, 'create']);
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::delete('/books/{book}/delete', [BookController::class, 'destroy'])->name('book.delete');
        Route::get('/books/{book}', [BookController::class, 'show'])->name('book.show');

        // Book Copy
        Route::get('/books/{book}/copies/create', [BookCopyController::class, 'create'])->name('copy.create');
        Route::post('/books/{book}/copies', [BookCopyController::class, 'store'])->name('copy.store');
        Route::delete('/books/{book}/copies/{copy}/delete', [BookCopyController::class, 'destroy'])->name('copy.delete');
        Route::get('/ajax/copies', [BookCopyController::class, 'ajax_get'])->name('copies.ajax.get');

        // Member
        Route::resource('/members', MemberController::class);

        // Book Category
        Route::resource('book-categories', BookCategoryController::class);

        // Profile
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

        // Loan
        Route::resource('loans', LoanController::class);
        Route::get('/ajax/members', [MemberController::class, 'ajax_get'])->name('members.ajax.get');

        // Return
        Route::resource('returns', ReturnController::class);

        // Visit
        Route::resource('/visits', VisitController::class);
    });


    Route::group(['middleware' => 'role:admin|developer'], function () {
        // Staffs / Users
        Route::resource('staffs', StaffController::class);

        // Setting
        Route::resource('/settings', SettingController::class);
    });
});
