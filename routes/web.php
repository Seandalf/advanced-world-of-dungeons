<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/character-sheet', 301);

Route::get('/character-sheet', [CharacterController::class, 'index'])->middleware(['auth'])->name('character');

require __DIR__ . '/auth.php';
