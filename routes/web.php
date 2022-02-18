<?php

use App\Http\Controllers\MusiciansController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('musicians', MusiciansController::class)->middleware('auth');

Route::resource('users', UserController::class)->middleware('auth');

Route::get('/', \App\Http\Livewire\ShowMusicians::class)->middleware('auth')->name('musicians-livewire');

Route::get('/addMusician', \App\Http\Livewire\AddMusician::class)->middleware('auth')->name('add-musician');

Route::get('/editMusician/{musician}', \App\Http\Livewire\EditMusician::class)->middleware('auth')->name('edit-musician');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
