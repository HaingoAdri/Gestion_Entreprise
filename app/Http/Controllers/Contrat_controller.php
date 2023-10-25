<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Liste_Adresse_entreprise;
use App\Models\Contrat_Essaie;
use App\Models\Historique_embauche;
use App\Models\Proche;
use App\Models\Genre;
use App\Models\Type_avantage_nature;
use App\Models\Avantage_nature;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

class Contrat_controller extends Controller
{

    // INDEX
    public function index() {
        $liste_nouveau_employer = (new Employer(etat: 12))->getListeEmployer_EntretientFini();
        $Liste_Adresse_entreprise = (new Liste_Adresse_entreprise())->getListeAdresse();
        return view("ajout_contrat_essaie", compact("liste_nouveau_employer", "Liste_Adresse_entreprise"));
    }

    public function ajout_contrat_essaie(Request $request) {
        $idEmploye = $request->input('idEmploye');
        $cin = $request->input('cin');
        $telephone = $request->input('telephone');
        $adresse = $request->input('adresse');
        $dateDebut = $request->input('dateDebut');
        $dateFin = $request->input('dateFin');
        $idLieu = $request->input('idLieu');
        $obligation = $request->input('obligation');
        $superieur = $request->input('superieur');

        $lieuDeTravail = new Liste_Adresse_entreprise(id: $idLieu);
        $contrat = new Contrat_Essaie("", $idEmploye, $lieuDeTravail, $dateDebut, $dateFin, $obligation, $superieur);
        $contrat->insert();

        $employe = new Employer(id_emp: $idEmploye);
        $employe->ajoutAutreDonnees($cin, $adresse, $telephone);

        $embauche = new Historique_embauche("", $idEmploye, $dateDebut, 15);
        $embauche->insert();
        $employe->etat = 15;
        $employe->updateEtat();

        Session::put('idEmploye', $idEmploye);
        Session::put('dateDebutEssaie', $dateDebut);
        return redirect()->route('proche');
    }

    public function inserer_proche() {
        return view("contrat_essaie/ajout_proche");
    }

    public function ajout_proche(Request $request) {
        $idEmploye = Session::get('idEmploye');
        $nom =$request->input('nom');
        $prenom =$request->input('prenom');
        $date =$request->input('date');
        $idGenre =$request->input('idGenre');
        $idEtat =$request->input('idEtat');
        $type =$request->input('type');

        $genre = new Genre($idGenre);
        $un_proche = new Proche("", $idEmploye, $nom, $prenom, $date, $genre, $idEtat);
        $un_proche->insert();

        if($type == "1") {
            return redirect()->route('proche');
        }       
        return redirect()->route('avantage_en_nature');
    }

    public function avantage_en_nature () {
        $Liste_avantage_nature = (new Type_avantage_nature())->getListeAvantage();
        return view("contrat_essaie/ajout_avantage", compact("Liste_avantage_nature"));
    }

    public function inserer_avantage(Request $request) {
        $idEmploye = Session::get('idEmploye');
        $dateDebutEssaie = Session::get('dateDebutEssaie');
        $idAvantage = $request->input('idAvantage');
        $type = $request->input('type');

        $avantage_nature = new Avantage_nature("", $idEmploye, new Type_avantage_nature(id: $idAvantage), $dateDebutEssaie, 8);
        $avantage_nature->insert();

        if($type == "1") {
            return redirect()->route('avantage_en_nature');
        }  
        Session::forget('idEmploye');
        Session::forget('dateDebutEssaie');
        return redirect()->route('contrat_essaie');
    }

    public function liste_contrat_renouveler() {
        $dateDuSysteme = (Carbon::now())->format('Y-m-d');
        // $dateDuSysteme = "2023-10-26";
        $listes_employees = array();
        $listes_contrats = (new Contrat_Essaie(date_fin: $dateDuSysteme))->getListes_Contrats_A_Renouveler();
        foreach($listes_contrats as $contrat) {
            $employe = (new Employer(id_emp: $contrat->id_emp))->getDonneesEmployer();
            $listes_employees[] = $employe;
        }
        return view('contrat_essaie/liste_contrat_renouveler', compact("listes_contrats", "listes_employees", "dateDuSysteme"));
    }

    public function renouveler_un_contrat(Request $request) {
        $idEmploye = $request->input('idEmploye');
        $date = $request->input('date');
        $employe = new Employer(id_emp: $idEmploye);

        $embauche = new Historique_embauche("", $idEmploye, $date, 20);
        $embauche->insert();

        $employe->etat = 20;
        $employe->updateEtat();
        return redirect()->route('liste_contrat_renouveler');

    }

}
