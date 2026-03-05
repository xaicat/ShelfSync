<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC / USER FRONTEND ROUTES ---
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/user/books', [UserController::class, 'showBooks'])->name('user.books');

// Contact Page Routes
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::post('/contact', [UserController::class, 'submitContact'])->name('contact.submit');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// --- USER AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rental System
    Route::get('/rent/{id}', [UserController::class, 'showRentForm'])->name('user.rent');
    Route::post('/rent', [UserController::class, 'processRent'])->name('user.rent.submit');
    
    // My Rents Page (NEW)
    Route::get('/my-rents', [UserController::class, 'myRents'])->name('user.my_rents');
});


// --- ADMIN ROUTES (Protected by 'admin' middleware) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // 2. Categories Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.delete');

    // 3. Books Management
    Route::get('/books', [AdminController::class, 'books'])->name('books');
    Route::get('/books/add', [AdminController::class, 'createBook'])->name('books.create');
    Route::post('/books', [AdminController::class, 'storeBook'])->name('books.store');
    Route::delete('/books/{id}', [AdminController::class, 'deleteBook'])->name('books.delete');
    Route::get('/books/edit/{id}', [AdminController::class, 'editBook'])->name('books.edit');
    Route::put('/books/update/{id}', [AdminController::class, 'updateBook'])->name('books.update');

    // 4. Member Management
    Route::get('/members', [AdminController::class, 'members'])->name('members');
});

require __DIR__.'/auth.php';