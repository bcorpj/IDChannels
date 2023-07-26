<?php

use App\Http\Livewire\Features\Auth\Login;
use App\Http\Livewire\Features\Dashboard\Index;
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


Route::get('/login', Login::class)->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/', Index::class);
});
