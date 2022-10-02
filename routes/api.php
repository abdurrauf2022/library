<?php

use App\Http\Controllers\API\AuthorAPIController;
use App\Http\Controllers\API\BindingAPIController;
use App\Http\Controllers\API\BookAPIController;
use App\Http\Controllers\API\CategoryAPIController;
use App\Http\Controllers\API\FormatAPIController;
use App\Http\Controllers\API\GenreAPIController;
use App\Http\Controllers\API\GlobalVariableAPIController;
use App\Http\Controllers\API\LanguageAPIController;
use App\Http\Controllers\API\LetterAPIController;
use App\Http\Controllers\API\PublisherAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/korisnik', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1'], function(){
// Users
Route::get('/korisnici', [UserAPIController::class, 'users']);
Route::get('/ucenici-svi', [UserAPIController::class, 'students']);
Route::get('/ucenici', [UserAPIController::class, 'studentsMale']);
Route::get('/ucenice', [UserAPIController::class, 'studentsFemale']);
Route::get('/bibliotekari-svi', [UserAPIController::class, 'librarians']);
Route::get('/bibliotekari', [UserAPIController::class, 'librariansMale']);
Route::get('/bibliotekarke', [UserAPIController::class, 'librariansFemale']);
Route::get('/tipovi-korisnika', [UserAPIController::class, 'userTypes']);
Route::get('/tipovi-korisnika-broj', [UserAPIController::class, 'userTypesCount']);

// Books
Route::get('/knjige', [BookAPIController::class, 'books']);
Route::get('/knjiga/{id}', [BookAPIController::class, 'showBook'])->name('show-book-api');
Route::post('/nova-knjiga', [BookAPIController::class, 'storeBook']);
Route::put('/izmijeni-knjigu/{id}', [BookAPIController::class, 'updateBook']);
Route::delete('/izbrisi-knjigu/{id}', [BookAPIController::class, 'destroyBook']);
Route::get('/trazi-knjigu/{title}', [BookAPIController::class, 'searchBook']);

// Categories
Route::get('/kategorije', [CategoryAPIController::class, 'categories']);
Route::get('/kategorija/{id}', [CategoryAPIController::class, 'showCategory'])->name('show-category-api');
Route::post('/nova-kategorija', [CategoryAPIController::class, 'storeCategory']);
Route::put('/izmijeni-kategoriju/{id}', [CategoryAPIController::class, 'updateCategory']);
Route::delete('/izbrisi-kategoriju/{id}', [CategoryAPIController::class, 'destroyCategory']);
Route::get('/trazi-kategoriju/{name}', [CategoryAPIController::class, 'searchCategory']);

// Genres
Route::get('/zanrovi', [GenreAPIController::class, 'genres']);
Route::get('/zanr/{id}', [GenreAPIController::class, 'showGenre'])->name('show-genre-api');
Route::post('/novi-zanr', [GenreAPIController::class, 'storeGenre']);
Route::put('/izmijeni-zanr/{id}', [GenreAPIController::class, 'updateGenre']);
Route::delete('/izbrisi-zanr/{id}', [GenreAPIController::class, 'destroyGenre']);
Route::get('/trazi-zanr/{name}', [GenreAPIController::class, 'searchGenre']);

// Publishers
Route::get('/izdavaci', [PublisherAPIController::class, 'publishers']);
Route::get('/izdavac/{id}', [PublisherAPIController::class, 'showPublisher'])->name('show-publisher-api');
Route::post('/novi-izdavac', [PublisherAPIController::class, 'storePublisher']);
Route::put('/izmijeni-izdavaca/{id}', [PublisherAPIController::class, 'updatePublisher']);
Route::delete('/izbrisi-izdavaca/{id}', [PublisherAPIController::class, 'destroyPublisher']);
Route::get('/trazi-izdavaca/{name}', [PublisherAPIController::class, 'searchPublisher']);

// Bindings
Route::get('/povezi', [BindingAPIController::class, 'bindings']);
Route::get('/povez/{id}', [BindingAPIController::class, 'showBinding'])->name('show-binding-api');
Route::post('/novi-povez', [BindingAPIController::class, 'storeBinding']);
Route::put('/izmijeni-povez/{id}', [BindingAPIController::class, 'updateBinding']);
Route::delete('/izbrisi-povez/{id}', [BindingAPIController::class, 'destroyBinding']);
Route::get('/trazi-povez/{name}', [BindingAPIController::class, 'searchBinding']);

// Formats
Route::get('/formati', [FormatAPIController::class, 'formats']);
Route::get('/format/{id}', [FormatAPIController::class, 'showFormat'])->name('show-format-api');
Route::post('/novi-format', [FormatAPIController::class, 'storeFormat']);
Route::put('/izmijeni-format/{id}', [FormatAPIController::class, 'updateFormat']);
Route::delete('/izbrisi-format/{id}', [FormatAPIController::class, 'destroyFormat']);
Route::get('/trazi-format/{name}', [FormatAPIController::class, 'searchFormat']);

// Letters
Route::get('/pisma', [LetterAPIController::class, 'letters']);
Route::get('/pismo/{id}', [LetterAPIController::class, 'showLetter'])->name('show-letter-api');
Route::post('/novo-pismo', [LetterAPIController::class, 'storeLetter']);
Route::put('/izmijeni-pismo/{id}', [LetterAPIController::class, 'updateLetter']);
Route::delete('/izbrisi-pismo/{id}', [LetterAPIController::class, 'destroyLetter']);
Route::get('/trazi-pismo/{name}', [LetterAPIController::class, 'searchLetter']);

// Languages
Route::get('/jezici', [LanguageAPIController::class, 'languages']);
Route::get('/jezik/{id}', [LanguageAPIController::class, 'showLanguage'])->name('show-language-api');
Route::post('/novi-jezik', [LanguageAPIController::class, 'storeLanguage']);
Route::put('/izmijeni-jezik/{id}', [LanguageAPIController::class, 'updateLanguage']);
Route::delete('/izbrisi-jezik/{id}', [LanguageAPIController::class, 'destroyLanguage']);
Route::get('/trazi-jezik/{name}', [LanguageAPIController::class, 'searchLanguage']);

// Authors
Route::get('/autori', [AuthorAPIController::class, 'authors']);
Route::get('/autor/{id}', [AuthorAPIController::class, 'showAuthor'])->name('show-author-api');
Route::post('/novi-autor', [AuthorAPIController::class, 'storeAuthor']);
Route::put('/izmijeni-autora/{id}', [AuthorAPIController::class, 'updateAuthor']);
Route::delete('/izbrisi-autora/{id}', [AuthorAPIController::class, 'destroyAuthor']);
Route::get('/trazi-autora/{NameSurname}', [AuthorAPIController::class, 'searchAuthor']);
Route::get('/autori-broj', [AuthorAPIController::class, 'authorsCount']);

// Global Variables
Route::get('/globalne-varijable', [GlobalVariableAPIController::class, 'globalVariables']);
Route::get('/globalna-varijabla/{id}', [GlobalVariableAPIController::class, 'showGlobalVariable'])->name('show-global-variable-api');
Route::post('/nova-globalna-varijabla', [GlobalVariableAPIController::class, 'storeGlobalVariable']);
Route::put('/izmijeni-globalnu-varijablu/{id}', [GlobalVariableAPIController::class, 'updateGlobalVariable']);
Route::delete('/izbrisi-globalnu-varijablu/{id}', [GlobalVariableAPIController::class, 'destroyGlobalVariable']);
Route::get('/trazi-globalnu-varijablu/{variable}', [GlobalVariableAPIController::class, 'searchGlobalVariable']);
Route::get('/globalne-varijable-broj', [GlobalVariableAPIController::class, 'globalVariablesCount']);
});



