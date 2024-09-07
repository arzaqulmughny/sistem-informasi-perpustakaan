<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCopyController;
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

    // Route::get('/register', function () {
    //     return view('register.index');
    // });
});


// For authenticated user page
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return view('index');
    })->name('dashboard');

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
});
