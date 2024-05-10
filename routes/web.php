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

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('dashboard', 'dashboard')
        ->name('dashboard');

    // Profile
    Volt::route('profile', 'pages.profile.index')
        ->name('profile');

    // Groups
    Route::prefix('groups')->name('groups.')->group(function () {
        Volt::route('/', 'pages.groups.index')
            ->name('index');

        Volt::route('{group}', 'pages.groups.detail')
            ->name('detail');
    });


    Volt::route('browse', 'browse')
        ->name('browse');

    // Predictions
    Route::prefix('predictions')->name('predictions.')->group(function () {
        Volt::route('/', 'pages.predictions.index')
            ->name('index');

        Volt::route('create', 'pages.predictions.create')
            ->name('create');

        Volt::route('{prediction}', 'pages.predictions.show')
            ->name('show');
    });
});

require __DIR__ . '/auth.php';
