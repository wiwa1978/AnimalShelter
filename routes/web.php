<?php

use App\Livewire\Home;
use App\Livewire\ShowAnimals;
use App\Livewire\ShowAnimalDetail;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Home::class)->name('home');
Route::get('/animals', ShowAnimals::class)->name('show-animals');
Route::get('/animal/detail/{id}', ShowAnimalDetail::class)->name('show-animal-detail');
