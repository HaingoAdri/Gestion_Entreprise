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
use App\Models\CV;
use App\Models\Details_Besoin_Age;
use App\Models\Details_Cv_Salaire;
use App\Models\Details_Cv_Fichier;
use App\Models\Details_Besoin_Diplome;
use App\Models\Details_Besoin_Experience;
use App\Models\Details_Besoin_Genre;
use App\Models\Details_Besoin_Matrimoniale;
use App\Models\Details_Besoin_Nationalite;
use App\Models\Details_Besoin_Region;
use App\Models\Details_Besoin_Salaire;
use App\Models\Details_Besoin_Ville;
use App\Models\Note_Cv;
use App\Models\Client;
use App\Models\Type_Contrat;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Besoin_controller extends Controller
{

    // INDEX
    public function index() {
        $listePostes = (new Poste())->getListePostes();
        $listeServices = (new Service())->getListeServices();
        $listeBesoins = (new Besoin())->getListeBesoins();        
        $listeTypeContrats = (new Type_Contrat())->getListeTypeContrats();
        
        return view("ajout_besoin", compact("listePostes","listeServices","listeBesoins","listeTypeContrats"));
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
    
    public function annonce() {
        $listeRegions = (new Region())->getListeRegions();
        $listeVilles = (new Ville())->getListeVilles();

        $listeSituations = (new Situation_Matrimoniale())->getListeSituation_Matrimoniales();

        $listeNationalites = (new Nationalite())->getListeNationalites();

        $listeDiplomes = (new Diplome())->getListeDiplomes();

        //liste Annonce:
        $listePostes = (new Poste())->getListePostes();
        $listeServices = (new Service())->getListeServices();
        $listeBesoins = (new Besoin())->getListeBesoins();

                
        return view("liste_annonce", compact("listePostes","listeServices","listeBesoins", "listeRegions","listeVilles", "listeSituations", "listeNationalites", "listeDiplomes"));
    }

    public function note_cv($idBesoin, $idNationalite, $idDiplome, $idSituation, $idRegion, $idVille, $experience, $salaire_min, $salaire_max) {
        $idClient = session('client')->id;
        $note = 0;

        $age = (new Client())->ageClient($idClient);
        $note += (new Details_Besoin_Age())->note_age_cv($idBesoin, $age);

        $note += (new Details_Besoin_Diplome())->note_diplome_cv($idBesoin, $idDiplome);

        $note += (new Details_Besoin_Experience())->note_cv_experience($idBesoin, $experience);

        $idGenre = session('client')->genre->id;
        $note += (new Details_Besoin_Genre())->note_genre_cv($idBesoin, $idGenre);

        $note += (new Details_Besoin_Matrimoniale())->note_situation_matrimonial($idBesoin, $idSituation);

        $note += (new Details_Besoin_Nationalite())->note_nationalite_cv($idBesoin, $idNationalite);

        $note += (new Details_Besoin_Region())->note_region_cv($idBesoin, $idRegion);

        $note += (new Details_Besoin_Salaire())->note_salaire_cv($idBesoin, $salaire_min, $salaire_max);

        $note += (new Details_Besoin_Ville())->note_ville_cv($idBesoin, $idVille);

        return $note;
        
    }

    public function ajout_cv(Request $request) {
        try {

            $request->validate([
                'file_diplome' => 'required|file|max:2048', // Limite à 2 Mo (2048 KB)
                'file_attestation' => 'required|file|max:2048'
            ]);
            
            $idBesoin = $request->input('idBesoin');
            $idNationalite = $request->input('idNationalite');
            $idDiplome = $request->input('idDiplome');
            $idRegion = $request->input('idRegion');
            $idVille = $request->input('idVille');
            $experience = $request->input('experience');
            $salaire_min = $request->input('salaire_min');
            $salaire_max = $request->input('salaire_max');
            $idSituation = $request->input('idSituation');
    
            $file_diplome = null;
            $file_attestation = null;
            $file_diplome_name = null;
            $file_attestation_name = null;
            
            $idClient = session('client')->id;
            echo $idClient;

            $cv = new CV($idClient,  $idBesoin, $idDiplome, $experience, $idSituation, $idVille);
            $cv->insert();
            $idCV = session('dernierCV')->id;
            $details_cv_salaire = new Details_Cv_Salaire($idCV, $salaire_min, $salaire_max);
            $details_cv_salaire->insert();

            $note = $this->note_cv($idBesoin, $idNationalite, $idDiplome, $idSituation, $idRegion, $idVille, $experience, $salaire_min, $salaire_max);
            $note_cv = new Note_Cv($idCV, $note);
            $note_cv->insert();
    
            if ($request->hasFile('file_diplome')) {
                $file_diplome = $request->file('file_diplome');
                $file_diplome_name = $idBesoin . '-1-' . time() . '-' . $file_diplome->getClientOriginalName();
                echo '<br>' . $file_diplome_name;
                $details_cv_fichier = new Details_Cv_Fichier($idCV, $file_diplome_name);
                $details_cv_fichier->insertDetails_Cv_Diplome();
                $file_diplome->storeAs('public', $file_diplome_name);
            }
            else  {
                throw new \Exception('Le fichier a telecharger ne doit pas depasser de 2 Mo (2048 KB)');
            }
    
            if ($request->hasFile('file_attestation')) {
                $file_attestation = $request->file('file_attestation');
                $file_attestation_name = $idBesoin . '-2-' . time() . '-' . $file_attestation->getClientOriginalName();
                echo '<br>' . $file_attestation_name;
                $details_cv_fichier = new Details_Cv_Fichier($idCV, $file_attestation_name);
                $details_cv_fichier->insertDetails_Cv_Travail_Anterieur();
                $file_attestation->storeAs('public', $file_attestation_name);
            }
            return redirect()->route('liste_annonce');
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            echo '<br>Erreur: ' . $e->getMessage();
            return redirect()->route('liste_annonce')->with('erreur', $e->getMessage());
        }



        // return Ok();
    }
}
