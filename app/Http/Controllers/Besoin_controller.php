<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Service;
use App\Models\Situation_Matrimoniale;
use App\Models\Nationalite;
use App\Models\Diplome;
use App\Models\Region;
use App\Models\Ville;
use App\Models\Besoin;
use App\Models\Details_Besoin_Age;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Besoin_controller extends Controller
{

    // INDEX
    public function index() {
        $listePostes = (new Poste())->getListePostes();
        $listeServices = (new Service())->getListeServices();
        $listeBesoins = (new Besoin())->getListeBesoins();
        
        return view("ajout_besoin", compact("listePostes","listeServices","listeBesoins"));
    }

    public function index_age() {
        return view("details_besoin/ajout_details_besoin_age");
    }

    public function index_genre_matrimoniale() {
        $listeSituations = (new Situation_Matrimoniale())->getListeSituation_Matrimoniales();
        
        return view("details_besoin/ajout_details_besoin_genre_matrimoniale", compact("listeSituations"));
    }

    public function index_nationalite() {
        $listeNationalites = (new Nationalite())->getListeNationalites();
        
        return view("details_besoin/ajout_details_besoin_nationalite", compact("listeNationalites"));
    }

    public function index_diplome() {
        $listeDiplomes = (new Diplome())->getListeDiplomes();
        
        return view("details_besoin/ajout_details_besoin_diplome", compact("listeDiplomes"));
    }

    public function index_region_ville() {
        $listeRegions = (new Region())->getListeRegions();
        $listeVilles = (new Ville())->getListeVilles();
        
        return view("details_besoin/ajout_details_besoin_region_ville", compact("listeRegions","listeVilles"));
    }

    public function index_experience() {
        return view("details_besoin/ajout_details_besoin_experience");
    }

    public function index_salaire() {
        return view("details_besoin/ajout_details_besoin_salaire");
    }

    // INSERTION
    public function insertion_Besoin(Request $request) {
        $id_poste = $request->input('poste_id');
        $id_service = $request->input('service_id');
        $horaireBesoin = $request->input('horaireBesoin');
        $tjh = $request->input('tjh');
        $description = $request->input('description');

        $besoin = new Besoin();
        $besoin->insertBesoin($id_poste, $id_service, $horaireBesoin, $tjh, $description);
        return redirect()->route('ajout_details_besoin_age');
    }
    
}
