<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Make sure path '/' goes to '/pocetna'
Route::get('/', function () {
    return to_route('redirect');
});
Route::get('/pocetna', function () {
    return view('welcome');
})->name('redirect');

Route::group(['middleware' => 'auth'], function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::controller(LibrarianController::class)->group(function() {
// Librarians
Route::get('/bibliotekari', [LibrarianController::class, 'index'])->name('all-librarian');
Route::get('/bibliotekar/{id}', [LibrarianController::class, 'show'])->name('show-librarian');
Route::get('/novi-bibliotekar', [LibrarianController::class, 'create'])->name('new-librarian');
Route::post('/novi-bibliotekar', [LibrarianController::class, 'store'])->name('store-librarian');
Route::delete('/izbrisi-bibliotekara/{id}', [LibrarianController::class, 'destroy'])->name('destroy-librarian');
});

Route::controller(StudentController::class)->group(function() {
// Students
Route::get('/studenti', [StudentController::class, 'index'])->name('all-student');
});
});

// Laravel Authentication route
Route::auth(['verify' => 'true']);

// Logout route
Route::get('/logout', [LoginController::class, 'logout']);

