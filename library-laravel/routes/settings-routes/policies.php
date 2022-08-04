<?php 

use Illuminate\Support\Facades\ {
    Route,
};

use App\Http\Controllers\Settings\ {
    PolicyController
};

Route::controller(PolicyController::class)->group(function() {

Route::put('/podesavanja/izmijeni-polisu/{id}', [PolicyController::class, 'update'])->name('update-policy');
    
});

; ?>
