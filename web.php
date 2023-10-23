<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inscription_controller;
use App\Http\Controllers\Connexion_controller;
use App\Http\Controllers\Service_controller;
use App\Http\Controllers\Poste_controller;
use App\Http\Controllers\Besoin_controller;
use App\Http\Controllers\Details_Besoin_controller;
use App\Http\Controllers\Qcm_controller;
use App\Http\Controllers\Tester_Qcm_Controller;

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
Route::get('/authentification_connexion', [Connexion_controller::class, "authentification_connexion"])->name("authentification_connexion");

//CONNEXION Client
Route::get('/login', [Connexion_controller::class, "login"])->name("login");
Route::get('/authentification_client', [Connexion_controller::class, "authentification_client"])->name("authentification_client");

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


// QCM
Route::get('/qcm_avoaka', [Qcm_controller::class, "annonce"])->name("qcm_avoaka");
Route::get('/ajouterQcm', [Qcm_controller::class, "insertQcm"])->name("ajouterQcm");
Route::get('/listeQcm', [Qcm_controller::class, "allQcmSelect"])->name("listeQcm");
Route::get('/inserer_Question', [Qcm_controller::class, "insererQuestionQcm"])->name("inserer_Question");
Route::get('/inserer_reponse{idqcm}', [Qcm_controller::class, "mampiditraReponseByQuestions"])->name("inserer_reponse");
Route::get('/mampiditraValiny', [Qcm_controller::class, "mampiditraReponse"])->name("mampiditraValiny");
Route::get('/reponse{idQ}', [Qcm_controller::class, "getFunctionByQuestion"])->name("reponse");


// Afaka manao qcm
Route::get('/afaka_Cv', [Tester_Qcm_Controller::class, "faire_Qcm"])->name("afaka_Cv");
Route::get('/result_Qcm', [Tester_Qcm_Controller::class, "insererResultatQcm"])->name("result_Qcm");

// afaka qcm
Route::get('/afaka{idqcm}', [Tester_Qcm_Controller::class, "afaka_Qcm"])->name("afaka");