<?php


use App\Livewire\Home\Home;
use App\Livewire\Home\Home1;
use App\Livewire\Animals\Animals;
use App\Livewire\Products\Products;
use Illuminate\Support\Facades\Route;
use App\Livewire\Animals\AnimalDetail;
use App\Livewire\Animals\AnimalsByUser;


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

//Route::get('/animals', Animals::class)->name('animals');
//Route::get('/products', Products::class)->name('products');

Route::get('/', Home::class)->name('home');
Route::get('/home1', Home1::class)->name('home1');
Route::get('/animals', Home::class)->name('show-animals');
Route::get('/animals/dogs', Animals::class)->name('show-dogs');
Route::get('/animals/cats', Animals::class)->name('show-cats');
Route::get('/animals/others', Animals::class)->name('show-others');
Route::get('/animal/{id}/detail/', AnimalDetail::class)->name('show-animal-detail');
Route::get('/animal/organization/{userId}', AnimalsByUser::class)->name('show-animal-organization');

Route::get('/products', Products::class)->name('products');

Route::get('/login', function () {
    return redirect(route('filament.app-ind.auth.login'));
})->name('login');

Route::get('/register', function () {
    return redirect(route('filament.app-ind.auth.register'));
})->name('register');
