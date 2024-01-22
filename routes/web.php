<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inscription_controller;
use App\Http\Controllers\Connexion_controller;
use App\Http\Controllers\Service_controller;
use App\Http\Controllers\Poste_controller;
use App\Http\Controllers\Besoin_controller;
use App\Http\Controllers\Details_Besoin_controller;
use App\Http\Controllers\Contrat_controller;
use App\Http\Controllers\Personnel_controller;
use App\Http\Controllers\Conge_controller;
use App\Http\Controllers\Tester_Qcm_Controller;
use App\Http\Controllers\Qcm_controller;
use App\Http\Controllers\Pointage_controller;
use App\Http\Controllers\Paie_controller;
use App\Http\Controllers\Etat_Paie_controller;
use App\Http\Controllers\Entretient_controller;
use App\Http\Controllers\Fournisseur_controller;
use App\Http\Controllers\PDF_controller;
use App\Http\Controllers\Bon_controller;
use App\Http\Controllers\Stock_Controller;
use App\Http\Controllers\Compte_controller;
use App\Http\Controllers\Tresorier_controller;
use App\Http\Controllers\Magasin_controller;
use App\Http\Controllers\Caisse_controller;
use App\Http\Controllers\Immobilier_controller;
use App\Http\Controllers\Pv_Reception_controller;

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

//Accueil
Route::get('/Accueil', [Connexion_controller::class, "accueil"])->name("accueil");

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

//personnel
Route::get('/recherche_un_personnel', [Personnel_controller::class, "index"])->name("recherche_un_personnel");
Route::post('/fiche_de_poste', [Personnel_controller::class, "fiche_de_poste"])->name("fiche_de_poste");
Route::get('/listes_personnels', [Personnel_controller::class, "listes_personnels"])->name("listes_personnels");
Route::get('/fiche_perso', [Personnel_controller::class, "fiche_personnel"])->name("fiche_personnel");
Route::get('/debouche', [Personnel_controller::class, "debouche"])->name("debouche");

// -- CONGE
// // -- CONGE
Route::get('/ajout_Conge', [Conge_controller::class, "index_employe"])->name("ajout_Conge");
Route::get('/accueil_Conge', [Conge_controller::class, "index_accueil_conge"])->name("accueil_Conge");
Route::get('/liste_demande', [Conge_controller::class, "index_liste_demande"])->name("liste_demande");
Route::get('/changeStatut/{id?}/{statut?}', [Conge_controller::class, "changeStatut"])->name("changeStatut");
Route::get('/liste_valider', [Conge_controller::class, "index_liste_valider"])->name("liste_valider");
Route::get('/liste_retour', [Conge_controller::class, "index_liste_confirmer_retour"])->name("liste_retour");

Route::get('/test', [Conge_controller::class, "test_date"])->name("test");

// -- INSERTION CONGE
Route::post('/insertion_conge', [Conge_controller::class, "insertion_conge"])->name("insertion_conge");
Route::get('/insertion_Type_Conge', [Conge_controller::class, "insertion_type_conge"])->name("insertion_type_conge");
Route::get('/insertion_confirmation_depart', [Conge_controller::class, "insertion_confirmation_depart"])->name("insertion_confirmation_depart");
Route::get('/insertion_confirmation_fin', [Conge_controller::class, "insertion_confirmation_fin"])->name("insertion_confirmation_fin");

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

//Entretient
Route::get('/entretient', [Entretient_Controller::class, "index"])->name("entretient");
Route::post('/inserer_entretient', [Entretient_Controller::class, "insert"])->name("inserer_entretient");
Route::get('/liste_entretient', [Entretient_Controller::class, "allEntretient"])->name("liste_entretient");
Route::get('/inserer_Vita_Entretient', [Entretient_Controller::class, "inserer_Ok_Vita_Entretient"])->name("inserer_Vita_Entretient");

// pointage
Route::get('/index_pointage', [Pointage_controller::class, "index"])->name("index_pointage");
Route::get('/insert_pointage', [Pointage_controller::class, "insert_pointage"])->name("insert_pointage");

//paie
Route::get('/voir_fiche_de_paie', [Paie_controller::class, "voir_fiche_de_paie"])->name("voir_fiche_de_paie");
Route::post('/fiche_de_paie', [Paie_controller::class, "fiche_de_paie"])->name("fiche_de_paie");

//etat de paie
Route::get('/voir_etat_de_paie', [Etat_Paie_controller::class, "voir_etat_de_paie"])->name("voir_etat_de_paie");
Route::post('/etat_de_paie', [Etat_Paie_controller::class, "listes_etat_de_paie"])->name("etat_de_paie");


Route::get('/getAll_One_Employer/{id_emp?}', [Conge_controller::class, "getAllConge_one_employer"])->name("getAll_One_Employer");
Route::get('/changeStatut_Subordonnees/{id?}/{statut?}', [Conge_controller::class, "changeStatut_Subordonnees"])->name("changeStatut_Subordonnees");

//achat
Route::get('/besoin_achat', [Besoin_controller::class, "besoinAchat"])->name("besoinAchat");
Route::get('/ajout_besoin_achat', [Besoin_controller::class, "ajoutBesoinAchat"])->name("ajoutBesoinAchat");
Route::get('/liste_besoin_achat', [Besoin_controller::class, "getListeBesoinAchatNonValide"])->name("listeBesoinAchatNonValide");
Route::get('/refuser_besoin_achat', [Besoin_controller::class, "refuserUneBesoinAchat"])->name("refuserUneBesoinAchat");
Route::get('/details_besoin_achat', [Besoin_controller::class, "getDetailsBesoinAchatNonValide"])->name("detailsBesoinAchat");
Route::get('/demande_de_proformat', [Besoin_controller::class, "faireUnNouveauDemande"])->name("faireUneDemande");
Route::post('/envoyer_la_demande_de_proformat', [Besoin_controller::class, "demandeProformat"])->name("demandeProformat");
Route::get('/liste_demande_en_attente_de_proformat', [Besoin_controller::class, "listeDemandeProformat"])->name("listeDemandeProformat");
Route::get('/details_du_proformat_du_demande', [Besoin_controller::class, "detailsDemandeProformat"])->name("detailsProformat");
Route::post('/ajouter_les_proformats', [Besoin_controller::class, "ajoutProformat"])->name("ajoutProformat");
Route::get('/tirer_un_bon_de_commande', [Besoin_controller::class, "tirerUneBonDeCommande"])->name("tirerUneBonDeCommande");
Route::post('/creation_du_bon_de_commande', [Besoin_controller::class, "genererLaBonDeCommande"])->name("creerLaBonDeCommande");
Route::get('/voir_un_bon_de_commande', [Besoin_controller::class, "recuUnBonDeCommande"])->name("voirBonDeCommande");
Route::get('/voir_liste_bon_de_commande_en_attente', [Besoin_controller::class, "listeBonCommandeEnAttente"])->name("listeBonCommandeEnAttente");
Route::get('/valider_un_bon_de_commande_en_attente', [Besoin_controller::class, "validerUnBonCommande"])->name("validerUnBonCommandeEnAttente");
Route::get('/liste_bon_de_commande_valider', [Besoin_controller::class, "listeBonCommandeApasser"])->name("listeBonCommandeApasser");
Route::get('/faire_le_bon_de_commande', [Besoin_controller::class, "passerUnBonCommande"])->name("passerUnBonCommande");
Route::get('/voir_liste_bon_de_commande_en_cours', [Besoin_controller::class, "listeBonCommandeEnCours"])->name("listeBonCommandeEnCours");



//fournisseur
Route::get('/liste_des_fournisseurs', [Fournisseur_controller::class, "index"])->name("listeFournisseur");
Route::post('/ajouter_un_nouveau_fournisseur', [Fournisseur_controller::class, "ajoutFournisseur"])->name("ajoutFournisseur");

//pdf
Route::get('/test_pdf', [PDF_controller::class, "demande"])->name("test_pdf");

// BON
Route::get('/bon_de_livraison_form', [Bon_controller::class, "show_bon_de_livraison"])->name("bon_de_livraison_form");
Route::get('/bon_de_reception_form', [Bon_controller::class, "show_bon_de_reception"])->name("bon_de_reception_form");
Route::get('/create_bon_de_livraison_form', [Bon_controller::class, "create_bon_de_livraison"])->name("create_bon_de_livraison_form");
Route::get('/create_bon_de_reception_form', [Bon_controller::class, "create_bon_de_reception"])->name("create_bon_de_reception_form");
Route::get('/validation_reception',[Bon_controller::class, "validation_bon_reception"])->name("validation_reception");
Route::get('/create_facture_livraison/{idBonCommande?}', [Bon_controller::class, "create_facture_livraison"])->name("create_facture_livraison");
Route::get('/fin_bon_commande/{idBonCommande?}', [Bon_controller::class, "terminerBonCommande"])->name("fin_bon_commande");
Route::get('/export_PDF/{idBonCommande?}', [Bon_controller::class, "export_PDF"])->name("export_PDF");

// Gestion de stock 
Route::get('/entre_manuelle',[Stock_Controller::class, "show_entrer_manuelle"])->name("entre_manuelle"); //manao insertion entre tanana
Route::get('/entre_checkBox',[Stock_Controller::class, "show_entrer_checkBox"])->name("entre_checkBox");// miditra insertion entre stock aminy alala an'i reception // manao demande d'explication
Route::get('/histporique_liste',[Stock_Controller::class, "show_historique"])->name("histporique_liste"); // mijery historique de d'entre 
Route::get('/liste_entre',[Stock_Controller::class, "show_liste_stock"])->name("liste_entre");// liste des entres natao
Route::get('/recherche_stock',[Stock_Controller::class, "show_recherche_stock"])->name("recherche_stock"); // recherche de stock
Route::get('/sortie_stock',[Stock_Controller::class,"show_sortie_stock"])->name("sortie_stock"); // sortie de stock formulaire
Route::get('/liste_sortie_stock',[Stock_Controller::class,"show_liste_sortie_stock"])->name("liste_sortie_stock");// liste sortie de stock
Route::get('/liste_vente',[Stock_Controller::class,"show_liste_vente"])->name("liste_vente");// liste des vente natao
Route::get('/recherche_vente',[Stock_Controller::class,"show_recherche_vente"])->name("recherche_vente");// rechercher de vente selon une date donnes
Route::get('/liste_stock_departement',[Stock_Controller::class, "show_liste_departement"])->name("liste_stock_departement"); // stock par departement
Route::get('/liste_explication',[Stock_Controller::class,"liste_explication_stock"])->name("liste_explication"); // voir les explication nitranga tao anaty mouvement 1
Route::post('/inserer_entre_check',[Stock_Controller::class,"insertion_Entre_Check_Box"])->name("inserer_entre_check");// insertion entre par checkBox
Route::get('/rechercher_stock',[Stock_Controller::class,"trouverStock"])->name("rechercher_stock");
Route::post('/inserer_Sortie',[Stock_Controller::class,"insertSortie"])->name("inserer_Sortie");
Route::post('/insert_entre_manuelle',[Stock_Controller::class,"insert_Entre_Manuelle"])->name("insert_entre_manuelle");
Route::post('/insert_explication',[Stock_Controller::class,"insertExplication"])->name("insert_explication");

//finance
Route::get('/liste_compte', [Compte_controller::class, "index"])->name("listeCompte");
Route::post('/ajout_compte', [Compte_controller::class, "ajoutCompte"])->name("ajoutCompte");

//tresorier
Route::get('/tresorier', [Tresorier_controller::class, "index"])->name("tresorier");
Route::post('/mouvement_argent', [Tresorier_controller::class, "mouvement"])->name("mouvementArgent");


//magasin
Route::get('/magasin', [Magasin_controller::class, "index"])->name("magasin");
Route::post('/nouveau_magasin', [Magasin_controller::class, "nouveauMagasin"])->name("nouveauMagasin");
Route::get('/caisse_magasin', [Magasin_controller::class, "voirCaisseMagasin"])->name("voirCaisseMagasin");
Route::post('/nouveau_caisse_magasin', [Magasin_controller::class, "nouveauCaisseMagasin"])->name("nouveauCaisseMagasin");

//caisse
Route::get('/caisse', [Caisse_controller::class, "index"])->name("caisse");
Route::post('/nouveau_caisse', [Caisse_controller::class, "nouveauCaisse"])->name("nouveauCaisse");

//Immobilisation
Route::get('/ajout_besoin_immobilisation', [Besoin_controller::class, "ajoutBesoinImmobilisation"])->name("ajoutBesoinImmobilisation");
Route::get('/refuser_besoin_immobilier', [Besoin_controller::class, "refuserUneBesoinImmobilier"])->name("refuserUneBesoinImmobilier");
Route::get('/liste_description_par_type_immobilisation', [Immobilier_controller::class, "index"])->name("listeDescriptionParType");
Route::post('/ajout_descripcion', [Immobilier_controller::class, "ajoutDescripcion"])->name("ajoutDescripcion");
Route::get('/ajout_lieu_immobilisation', [Pv_Reception_controller::class, "nouveauLieu"])->name("ajout_lieu_immobilisation");
Route::get('/insert_lieu_immobilisation', [Pv_Reception_controller::class, "insertLieu"])->name("insert_lieu_immobilisation");
Route::get('/ajout_etat_immobilisation', [Pv_Reception_controller::class, "nouvelleEtat"])->name("ajout_etat_immobilisation");
Route::get('/insert_etat_immobilisation', [Pv_Reception_controller::class, "insertEtat"])->name("insert_etat_immobilisation");
Route::get('/ajout_livreur_immobilisation', [Pv_Reception_controller::class, "nouveauLivreur"])->name("ajout_livreur_immobilisation");
Route::get('/insert_livreur_immobilisation', [Pv_Reception_controller::class, "insertLivreur"])->name("insert_livreur_immobilisation");
Route::get('/ajout_pv_reception', [Pv_Reception_controller::class, "index"])->name("ajout_pv_reception");
Route::get('/insert_pv_reception', [Pv_Reception_controller::class, "insertPvReception"])->name("insert_pv_reception");
