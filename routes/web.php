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

    Volt::route('groups', 'pages.groups.index')
        ->name('groups.index');

    Volt::route('browse', 'browse')
        ->name('browse');

    Volt::route('predictions/create', 'pages.predictions.create')
        ->name('predictions.create');

    Volt::route('predictions', 'pages.predictions.index')
        ->name('predictions.index');
});

require __DIR__ . '/auth.php';
