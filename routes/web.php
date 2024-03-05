<?php

use App\Livewire\Home;
use App\Livewire\Home1;
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
Route::get('/home1', Home1::class)->name('home1');
Route::get('/animals', Home::class)->name('show-animals');
Route::get('/animals/dogs', ShowAnimals::class)->name('show-dogs');
Route::get('/animals/cats', ShowAnimals::class)->name('show-cats');
Route::get('/animals/others', ShowAnimals::class)->name('show-others');
Route::get('/animal/detail/{id}', ShowAnimalDetail::class)->name('show-animal-detail');
Route::get('/login', function () {
    return redirect(route('filament.usr.auth.login'));
})->name('login');

Route::get('/register', function () {
    return redirect(route('filament.usr.auth.register'));
})->name('register');
