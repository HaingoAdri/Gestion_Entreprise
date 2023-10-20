<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inscription_controller;
use App\Http\Controllers\Connexion_controller;
use App\Http\Controllers\Service_controller;
use App\Http\Controllers\Poste_controller;
use App\Http\Controllers\Besoin_controller;
use App\Http\Controllers\Details_Besoin_controller;
use App\Http\Controllers\Contrat_controller;

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

//DECONNEXION
Route::get('/deconnexion', [Connexion_controller::class, "deconnect"])->name("deconnexion");

// CONNEXION
Route::get('/', [Connexion_controller::class, "index"])->name("connexion");
Route::post('/authentification_connexion', [Connexion_controller::class, "authentification_connexion"])->name("authentification_connexion");
//CONNEXION Client
Route::get('/login', [Connexion_controller::class, "login"])->name("login");
Route::post('/authentification_client', [Connexion_controller::class, "authentification_client"])->name("authentification_client");

// INSCRIPTION
Route::get('/inscription', [Inscription_controller::class, "index"])->name("inscription");
Route::post('/authentification_inscription', [Inscription_controller::class, "authentification_inscription"])->name("authentification_inscription");
// INSCRIPTION 
Route::get('/inscription_client', [Inscription_controller::class, "inscription"])->name("inscription_client");
Route::post('/authentification_inscription_client', [Inscription_controller::class, "inscription_client"])->name("authentification_inscription_client");


// SERVICES
Route::get('/ajout_service', [Service_controller::class, "index"])->name("ajout_service");
Route::get('/insert_service', [Service_controller::class, "insertService"])->name("insert_service");

// POSTES
Route::get('/ajout_poste', [Poste_controller::class, "index"])->name("ajout_poste");
Route::get('/insert_poste', [Poste_controller::class, "insertPoste"])->name("insert_poste");

// BESOINS
Route::get('/ajout_besoin', [Besoin_controller::class, "index"])->name("ajout_besoin");
Route::get('/insertion_Besoin', [Besoin_controller::class, "insertion_Besoin"])->name("insertion_Besoin");

// DETAILS_BESOIN
Route::get('/ajout_details_besoin_age', [Besoin_controller::class, "index_age"])->name("ajout_details_besoin_age");
Route::get('/ajout_details_besoin_genre_matrimoniale', [Besoin_controller::class, "index_genre_matrimoniale"])->name("ajout_details_besoin_genre_matrimoniale");
Route::get('/ajout_details_besoin_nationalite', [Besoin_controller::class, "index_nationalite"])->name("ajout_details_besoin_nationalite");
Route::get('/ajout_details_besoin_diplome', [Besoin_controller::class, "index_diplome"])->name("ajout_details_besoin_diplome");
Route::get('/ajout_details_besoin_region_ville', [Besoin_controller::class, "index_region_ville"])->name("ajout_details_besoin_region_ville");
Route::get('/ajout_details_besoin_experience', [Besoin_controller::class, "index_experience"])->name("ajout_details_besoin_experience");
Route::get('/ajout_details_besoin_salaire', [Besoin_controller::class, "index_salaire"])->name("ajout_details_besoin_salaire");

// -- INSERTION DETAILS
Route::get('/insertion_Details_Age', [Details_Besoin_controller::class, "insertion_Details_Age"])->name("insertion_Details_Age");
Route::get('/insertion_Details_Genre_Matrimoniale', [Details_Besoin_controller::class, "insertion_Details_Genre_Matrimoniale"])->name("insertion_Details_Genre_Matrimoniale");
Route::get('/insertion_Details_Nationalite', [Details_Besoin_controller::class, "insertion_Details_Nationalite"])->name("insertion_Details_Nationalite");
Route::get('/insertion_Details_Diplome', [Details_Besoin_controller::class, "insertion_Details_Diplome"])->name("insertion_Details_Diplome");
Route::get('/insertion_Details_Region_Ville', [Details_Besoin_controller::class, "insertion_Details_Region_Ville"])->name("insertion_Details_Region_Ville");
Route::get('/insertion_Details_Experience', [Details_Besoin_controller::class, "insertion_Details_Experience"])->name("insertion_Details_Experience");
Route::get('/insertion_Details_Salaire', [Details_Besoin_controller::class, "insertion_Details_Salaire"])->name("insertion_Details_Salaire");

// web.php
Route::get('/send-ville/{idRegion}', [Details_Besoin_controller::class, "sendVille"]);
Route::get('/liste_annonce', [Besoin_controller::class, "annonce"])->name("liste_annonce");
Route::get('/accueil', function () {
    return view('accueil');
});

//CV
Route::post('/ajout_cv', [Besoin_controller::class, "ajout_cv"])->name("ajout_cv");

//contrat d'essaie
Route::get('/liste_contrat_essaie_a_faire', [Contrat_controller::class, "index"])->name("contrat_essaie");
Route::post('/ajout_contrat_essaie', [Contrat_controller::class, "ajout_contrat_essaie"])->name("ajout_contrat_essaie");
Route::get('/ajout_menbre_famille', [Contrat_controller::class, "inserer_proche"])->name("proche");
Route::post('/ajout_proche', [Contrat_controller::class, "ajout_proche"])->name("ajout_proche");
Route::get('/avantage_en_nature', [Contrat_controller::class, "avantage_en_nature"])->name("avantage_en_nature");
Route::post('/inserer_avantage', [Contrat_controller::class, "inserer_avantage"])->name("inserer_avantage");

//contrat renouveler
Route::get('/liste_contrat_a_renouveler', [Contrat_controller::class, "liste_contrat_renouveler"])->name("liste_contrat_renouveler");
Route::get('/renouveler', [Contrat_controller::class, "renouveler_un_contrat"])->name("renouveler_un_contrat");
