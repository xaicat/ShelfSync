<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ── PUBLIC ROUTES ─────────────────────────────────────────────
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/user/books', [UserController::class, 'showBooks'])->name('user.books');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::post('/contact', [UserController::class, 'submitContact'])->name('contact.submit');

// ── DASHBOARD REDIRECT ────────────────────────────────────────
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── USER AUTHENTICATED ROUTES ─────────────────────────────────
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Rental System
    Route::get('/rent/{id}', [UserController::class, 'showRentForm'])->name('user.rent');
    Route::post('/rent',     [UserController::class, 'processRent'])->name('user.rent.submit');
    Route::get('/my-rents',  [UserController::class, 'myRents'])->name('user.my_rents');

    // Reading Tracker
    Route::post('/reading/add',          [UserController::class, 'addReading'])->name('user.reading.add');
    Route::patch('/reading/{id}/progress',[UserController::class, 'updateProgress'])->name('user.reading.progress');
    Route::patch('/reading/{id}/mark-read',[UserController::class, 'markRead'])->name('user.reading.mark_read');

    // Wishlist Toggle (AJAX)
    Route::post('/wishlist/toggle/{bookId}', [UserController::class, 'toggleWishlist'])->name('user.wishlist.toggle');
});

// ── ADMIN ROUTES ───────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Rental Management
    Route::get('/rentals',               [AdminController::class, 'rentals'])->name('rentals');
    Route::patch('/rentals/{id}/approve',[AdminController::class, 'approveRental'])->name('rentals.approve');
    Route::patch('/rentals/{id}/return', [AdminController::class, 'returnRental'])->name('rentals.return');
    Route::patch('/rentals/{id}/reject', [AdminController::class, 'rejectRental'])->name('rentals.reject');

    // Categories
    Route::get('/categories',        [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories',       [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{id}',[AdminController::class, 'deleteCategory'])->name('categories.delete');

    // Books
    Route::get('/books',              [AdminController::class, 'books'])->name('books');
    Route::get('/books/add',          [AdminController::class, 'createBook'])->name('books.create');
    Route::post('/books',             [AdminController::class, 'storeBook'])->name('books.store');
    Route::delete('/books/{id}',      [AdminController::class, 'deleteBook'])->name('books.delete');
    Route::get('/books/edit/{id}',    [AdminController::class, 'editBook'])->name('books.edit');
    Route::put('/books/update/{id}',  [AdminController::class, 'updateBook'])->name('books.update');

    // Members (with role management)
    Route::get('/members',              [AdminController::class, 'members'])->name('members');
    Route::patch('/members/{id}/promote',[AdminController::class, 'promoteUser'])->name('members.promote');
    Route::patch('/members/{id}/demote', [AdminController::class, 'demoteUser'])->name('members.demote');
});

require __DIR__.'/auth.php';