<?php

use App\Livewire\Front\Home;
//use App\Livewire\Front\Price;
use App\Http\Middleware\Cors;
use App\Livewire\Animals\Animals;
use App\Livewire\AcceptInvitation;
use Illuminate\Support\Facades\Route;
use App\Livewire\Animals\AnimalDetail;
use App\Livewire\Animals\SearchAnimal;
use App\Livewire\Animals\AnimalsByWeek;
use App\Livewire\Animals\AnimalsByOrganization;
use App\Http\Middleware\PreventRequestsDuringMaintenance;

Route::middleware('signed')
    ->get('/invitation/{invitation}/accept', AcceptInvitation::class)
    ->name('invitation-accept');

Route::middleware([PreventRequestsDuringMaintenance::class])->group(function () {
    Route::get('/', Home::class)->name('home');
    //Route::get('/price', Price::class)->name('pricing');
    Route::get('/animals/search', SearchAnimal::class)->name('search-animal');
    Route::get('/animals', Home::class)->name('show-animals');
    Route::get('/animals/dogs', Animals::class)->name('show-dogs');
    Route::get('/animals/dogs/featured', Animals::class)->name('show-featured-dogs');
    Route::get('/animals/cats', Animals::class)->name('show-cats');
    Route::get('/animals/cats/featured', Animals::class)->name('show-featured-cats');
    Route::get('/animals/others', Animals::class)->name('show-others');
    Route::get('/animals/others/featured', Animals::class)->name('show-featured-others');
    Route::get('/animals/week', AnimalsByWeek::class)->name('show-animal-week');
    Route::get('/animal/{animal}/detail/', AnimalDetail::class)->name('show-animal-detail');
    Route::get('/animal/organization/{organization}', AnimalsByOrganization::class)->name('show-animal-organization');
});

Route::get('buckets', function(){
    $disk = 's3';
    $heroImage = asset('storage/images/icon_logo.svg');
    //dd( $heroImage);
    $uploadedPath = Storage::disk($disk)->put('hero.png', $heroImage);
    return Storage::disk($disk)->url($uploadedPath);
});

Route::post('/broadcast', function () {
    Broadcast::on('global')
        ->as('Message')
        ->with([
            'body' => str()->random(10)
        ])
        ->sendNow();
});

Route::get('/login', function () {
    return redirect(route('filament.app.auth.login'));
})->name('login');

Route::get('/register', function () {
    return redirect(route('filament.app.auth.register'));
})->name('register');


