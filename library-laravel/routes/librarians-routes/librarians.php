<?php 

use Illuminate\Support\Facades\ {
    Route,
};

use App\Http\Controllers\ {
    LibrarianController,
    UserController
};

Route::controller(LibrarianController::class)->group(function() {
// Librarians
Route::get('/bibliotekari', [LibrarianController::class, 'index'])->name('all-librarian');
Route::get('/bibliotekar/{user:username}', [LibrarianController::class, 'show'])->name('show-librarian');
Route::get('/novi-bibliotekar', [LibrarianController::class, 'create'])->name('new-librarian');
Route::post('/novi-bibliotekar', [LibrarianController::class, 'store'])->name('store-librarian');
Route::get('/izmijeni/profil-bibliotekara/{id}', [LibrarianController::class, 'edit'])->name('edit-librarian');
Route::put('/izmijeni-profil-bibliotekara/{id}', [LibrarianController::class, 'update'])->name('update-librarian');
Route::delete('/izbrisi-bibliotekara/{user:username}', [LibrarianController::class, 'destroy'])->name('destroy-librarian');
Route::post('/resetuj-lozinku/{user}', [UserController::class, 'resetPassword'])->name('resetPassword');
Route::post('/crop', [LibrarianController::class, 'crop'])->name('librarian.crop');
});

?>
