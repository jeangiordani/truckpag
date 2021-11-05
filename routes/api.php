<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/cities/{state}', [CityController::class, 'loadCities'])->name('get.cities');


Route::post('/address', [AddressController::class, 'store'])->name('post.address');
Route::get('/address', [AddressController::class, 'index'])->name('get.addresses');
Route::get('/address/{id}', [AddressController::class, 'show'])->name('get.address');
Route::put('/address/{id}', [AddressController::class, 'update'])->name('update.address');
Route::delete('/address/{id}', [AddressController::class, 'destroy'])->name('delete.address');
