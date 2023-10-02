<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inscription_controller;
use App\Http\Controllers\Connexion_controller;

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

Route::get('/', [Connexion_controller::class, "index"])->name("connexion");

Route::get('/authentification_connexion', [Connexion_controller::class, "authentification_connexion"])->name("authentification_connexion");

Route::get('/inscription', [Inscription_controller::class, "index"])->name("inscription");

Route::get('/authentification_inscription', [Inscription_controller::class, "authentification_inscription"])->name("authentification_inscription");

Route::get('/accueil', function () {
    return view('accueil');
});
