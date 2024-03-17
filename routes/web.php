<?php

use App\Livewire\Home\Home;
use App\Livewire\Animals\Animals;
use App\Livewire\Home\SearchAnimal;
use Illuminate\Support\Facades\Route;
use App\Livewire\Animals\AnimalDetail;
use App\Livewire\Animals\AnimalsByOrganization;

Route::get('/', Home::class)->name('home');
Route::get('/animals/search', SearchAnimal::class)->name('search-animal');
Route::get('/animals', Home::class)->name('show-animals');
Route::get('/animals/dogs', Animals::class)->name('show-dogs');
Route::get('/animals/cats', Animals::class)->name('show-cats');
Route::get('/animals/others', Animals::class)->name('show-others');
Route::get('/animal/{animal}/detail/', AnimalDetail::class)->name('show-animal-detail');
Route::get('/animal/organization/{organization}', AnimalsByOrganization::class)->name('show-animal-organization');


Route::get('/login', function () {
    return redirect(route('filament.app.auth.login'));
})->name('login');

Route::get('/register', function () {
    return redirect(route('filament.app.auth.register'));
})->name('register');

#test