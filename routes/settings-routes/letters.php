<?php 

use Illuminate\Support\Facades\ {
    Route,
};

use App\Http\Controllers\Settings\ {
    LetterController
};

Route::controller(LetterController::class)->group(function() {
Route::get('/podesavanja/novo-pismo', [LetterController::class, 'index'])->name('new-letter');
Route::post('/podesavanja/kreiranje-novog-pisma', [LetterController::class, 'store'])->name('store-letter');
Route::delete('/podesavanja/brisanje-pisma/{id}', [LetterController::class, 'destroy'])->name('destroy-letter');
Route::get('/podesavanja/izmijeni-pismo/{letter:name}', [LetterController::class, 'edit'])->name('edit-letter');
Route::put('/podesavanja/izmijeni-pismo/{id}', [LetterController::class, 'update'])->name('update-letter');
});

// Additional features

// For multiple author delete
Route::delete('izbrisi-sva/pisma', [LetterController::class, 'deleteMultiple'])->name('delete-all-letters');

// Middleware protection
Route::middleware('user-delete')->group(function() {
// Protection for deleting a certain letter through URI
Route::get('/podesavanja/pisma/{id}', function ($id) {});
Route::post('/podesavanja/pisma/{id}', [LetterController::class, 'destroy'])->name('letters.destroy');
});

?>
