<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Volt::route('dashboard', 'dashboard')
        ->name('dashboard');

    Volt::route('profile', 'profile')
        ->name('profile');

    Route::prefix('groups')->name('groups.')->group(function () {
        Volt::route('/', 'pages.groups.index')
            ->name('index');

        Volt::route('{group}', 'pages.groups.detail')
            ->name('detail');
    });


    Volt::route('browse', 'browse')
        ->name('browse');

    Volt::route('predictions/create', 'pages.predictions.create')
        ->name('predictions.create');

    Volt::route('predictions', 'pages.predictions.index')
        ->name('predictions.index');
});

require __DIR__ . '/auth.php';
