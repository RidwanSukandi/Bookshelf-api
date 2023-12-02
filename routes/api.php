<?php

use App\Http\Controllers\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/books', [Books::class, 'store']);
Route::get('/books', [Books::class, 'index']);
Route::get('/books/{bookId}', [Books::class, 'show']);
Route::put('/books/{bookId}', [Books::class, 'update']);
Route::delete('/books/{bookId}', [Books::class, 'destroy']);
