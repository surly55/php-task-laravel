<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//LOGIN ROUTE
Route::get('/',function () { return view('login'); })->name('login');

//LOGIN ROUTE - GET TOKEN
Route::post('/login', [AuthController::class, 'login']);


//DASHBOARD PAGE - AFTER LOGIN 
Route::middleware(['checkToken'])->group(function () {
	Route::get('/booklet', [AuthorsController::class, 'booklet'], function () {
	})->name('booklet');
});

//DATATABLE ROUTE FOR LISTING ALL AUTHORS
Route::get('/authors', [AuthorsController::class, 'getAuthors']);


//AUTHOR DETAILS
Route::middleware(['checkToken'])->group(function () {
	Route::get('author/{id}', [AuthorController::class, 'getAuthorBooks'], function () {
	})->name('authorBooks');
});


//ADD AUTHOR
Route::post('/addAuthor', [AuthorController::class, 'addAuthor']);

//DELETE AUTHOR
Route::post('/deleteAuthor', [AuthorController::class, 'deleteAuthor']);


//GET ALL BOOKS
Route::middleware(['checkToken'])->group(function () {
	Route::get('/booklist', [BooksController::class, 'books'], function () {
	})->name('books');
});

//DATATABLE ROUTE FOR LISTING ALL BOOKS
Route::get('/books', [BooksController::class, 'getBooks']);

//SAVE BOOK
Route::post('/saveBook', [BooksController::class, 'saveBook']);

//SAVE BOOK
Route::post('/deleteBook', [BooksController::class, 'deleteBook']);


//LOGOUT
Route::get('/logout', [AuthController::class, 'logout']);




 