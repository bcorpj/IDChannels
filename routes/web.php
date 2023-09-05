<?php

use App\Http\Livewire\Features\Auth\Login;
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


Route::get('/login', Login::class)->middleware('guest')->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/', \App\Http\Livewire\Features\Dashboard\Index::class)->name('dashboard');
    Route::get('/reference', \App\Http\Livewire\Features\Reference\Index::class)->name('reference');
    Route::prefix('/reference')->group(function () {
        Route::get('/channel', \App\Http\Livewire\Features\Reference\ChannelType::class)->name('reference-channel');
        Route::get('/direction', \App\Http\Livewire\Features\Reference\DirectionLevel::class)->name('reference-direction');
        Route::get('/traffic', \App\Http\Livewire\Features\Reference\TrafficType::class)->name('reference-traffic');
        Route::get('/transmission', \App\Http\Livewire\Features\Reference\TransmissionType::class)->name('reference-transmission');
        Route::get('/type', \App\Http\Livewire\Features\Reference\Type::class)->name('reference-type');
    });
});
