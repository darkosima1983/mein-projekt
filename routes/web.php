<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\UserCitiesController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/theme/{mode}', function ($mode) {
    if (in_array($mode, ['light', 'dark'])) {
        session(['theme' => $mode]);
    }
    return redirect()->back();
})->name('theme.switch');
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/search', [HomePageController::class, 'search'])->name('search');

Route::get("/forecast/{city:name}", [ForecastController::class, 'index']);

/**User City Routes */
Route::get('/user-cities/favorite/{city}', [UserCitiesController::class, 'favorite'])->name('user-cities.favorite');

Route::middleware(['auth', AdminCheckMiddleware::class])
    ->prefix('admin')
    ->group(function () {

Route::get('/all-cities', [WeatherController::class,'getAllWeathers'])->name('all-cities');

Route::get('/add-city', [WeatherController::class, 'index'])->name('add-city');
Route::post('/add-city', [WeatherController::class, 'store'])->name('add-city.store');


Route::get('/edit-city/{weather}', [WeatherController::class, 'edit'])->name('edit-city');
Route::post('/update-city/{weather}', [WeatherController::class, 'update'])->name('update-city');
Route::delete('/delete-city/{weather}', [WeatherController::class, 'destroy'])->name('delete-city');

Route::get('/forecast', [ForecastController::class, 'show'])->name('forecast');
Route::post('/forecast/store', [ForecastController::class, 'store'])->name('forecast.store');


});

require __DIR__.'/auth.php';
