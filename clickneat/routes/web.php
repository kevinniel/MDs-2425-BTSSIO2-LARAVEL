<?php

use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}/show', [RestaurantController::class, 'show'])->name('restaurants.show');
Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
Route::get('/restaurants/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
Route::put('/restaurants/{id}/update', [RestaurantController::class, 'update'])->name('restaurants.update');
Route::delete('/restaurants/{id}/destroy', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
