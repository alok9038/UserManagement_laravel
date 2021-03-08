<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AGTController;

Route::get('/',[AGTController::class,"index"])->name('homepage');

Route::post('/store',[AGTController::class,"store"])->name('store');
Route::put('/update/{id}',[AGTController::class,"edit"])->name('edit');

Route::delete('/drop/{id}',[AGTController::class,"drop"])->name('drop');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
