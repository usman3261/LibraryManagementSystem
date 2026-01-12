<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowedController;
use Illuminate\Http\Request;


// --- 1. PUBLIC ROUTES ---
Route::get('/add-user', [UserController::class, 'index'])->name('addUser');
Route::post('/user-submit', [UserController::class, 'store'])->name('user-submit');

Route::get('/login-user', [UserController::class, 'login'])->name('login-user');
Route::post('/login-user', [UserController::class, 'authLogin'])->name('login');


// --- 2. PROTECTED ROUTES (Must be logged in only) ---
// REMOVED 'verified' middleware from the array below
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Librarian User Management
    Route::get('/user-show', [UserController::class, 'show'])->name('userShow');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/user-update', [UserController::class, 'update'])->name('userUpdate');
    Route::post('/user-destroy', [UserController::class, 'destroy'])->name('userDestroy');

    // Librarian Book Management
    Route::get('/add-book', [BookController::class, 'create'])->name('addBook');
    Route::post('/book-submit', [BookController::class, 'store'])->name('book-submit');
    Route::get('/book-show', [BookController::class, 'index'])->name('bookShow');
    Route::post('/book-edit', [BookController::class, 'edit'])->name('bookEdit');
    Route::post('/book-update', [BookController::class, 'update'])->name('bookUpdate');
    Route::post('/book-delete', [BookController::class, 'destroy'])->name('bookDelete');

    // Librarian Transaction Management
    Route::get('/borrowed-index', [BorrowedController::class, 'index'])->name('borrowIndex');
    Route::get('/issue-form/{bookId}', [BorrowedController::class, 'issueForm'])->name('issueForm');
    Route::post('/issue-book', [BorrowedController::class, 'issueBook'])->name('issueBook');
    Route::post('/return-book', [BorrowedController::class, 'returnBook'])->name('returnBook');
    Route::get('/pending-requests', [BorrowedController::class, 'pendingRequests'])->name('pendingRequests');
    Route::post('/approve-request/{requestId}', [BorrowedController::class, 'approveRequest'])->name('approveRequest');

    // Student Specific Routes
    Route::get('/student-history', [BorrowedController::class, 'studentHistory'])->name('studentHistory');
    Route::get('/student-book-show', [BookController::class, 'studentIndex'])->name('studentBookShow');
    Route::get('/book-request/{bookId}', [BorrowedController::class, 'logBookRequest'])->name('bookRequest');
});