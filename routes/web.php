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

    Volt::route('groups', 'groups')
        ->name('groups');

    Volt::route('browse', 'browse')
        ->name('browse');
});

require __DIR__ . '/auth.php';
