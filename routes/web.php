<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminCheckMiddleware;



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

Route::middleware(['auth', AdminCheckMiddleware::class])
    ->prefix('admin')
    ->group(function () {

Route::get('/all-cities', [WeatherController::class,'getAllWeathers'])->name('AlleStaedte');

Route::get('/add-city', [WeatherController::class, 'index'])->name('StaedteHinzufügen');
Route::post('/add-city', [WeatherController::class, 'store'])->name('admin.add-city.store');


Route::get('/edit-city/{weather}', [WeatherController::class, 'edit'])->name('admin.edit-city');
Route::post('/update-city/{weather}', [WeatherController::class, 'update'])->name('admin.update-city');
Route::delete('/delete-city/{weather}', [WeatherController::class, 'destroy'])->name('admin.delete-city');
});
require __DIR__.'/auth.php';
