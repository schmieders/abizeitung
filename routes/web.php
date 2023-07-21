<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [FormController::class, 'create'])->name('form');
    Route::post('/', [FormController::class, 'store']);
    Route::get('/image', [FormController::class, 'createImage'])->name('image');
    Route::post('/image', [FormController::class, 'storeImage']);
});

require __DIR__ . '/auth.php';
