<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lieu;
use App\Models\Compte;
use Carbon\Carbon;
use App\Models\Etat_immobilisation;
use App\Models\Pv_Reception;
use App\Models\Fournisseur;
use App\Models\Livreur;
use App\Models\BonCommande;
use App\Models\Proformat;
use App\Models\Article;
use App\Models\Details_Pv_Reception;
use App\Models\Immobilisation_reception;
use App\Models\Inventaire;
use App\Models\Categorie;
use App\Models\Maintenance;

use App\Http\Controllers\Pv_Reception_controller;

use Illuminate\Support\Facades\Session;

class Maintenance_controller extends Controller
{
    
    public function listeMaintenance(){
        $listeImmobilisationInutilisable = (new Immobilisation_reception())->getListeImmobilisationInutilisable();
        return view("maintenance/liste_maintenance", compact('listeImmobilisationInutilisable'));
    }

    public function insertMaintenanceForm(Request $request){
        $maintenance = new Maintenance();
        $listeTypeEntretien = $maintenance->getListeTypeEntretient();
        $id_immobilisation_reception = $request->get('id_immoblisation_reception');
        return view("maintenance/insert_maintenance", compact('listeTypeEntretien', 'id_immobilisation_reception'));
    }

    public function insertMaintenance(Request $request){
        $type = $request->get('type_entretient');
        $immobilisation = $request->get('immobilisation');
        $debut = $request->get('debut');
        $description = $request->get('designation');
        $etat_entretien = "EE000001";

        $maintenance = new Maintenance(id_immobilisation_reception: $immobilisation, id_type_entretien: $type, debut_maintenance: $debut, id_etat_entretien: $etat_entretien, description: $description);
        $maintenance->insert();

        $immobilisation_reception = new Immobilisation_reception();
        $immobilisation_reception->updateImmobilisationEnCoursMaintenance($immobilisation);

        return redirect()->route('liste_maintenance_en_cours');
    }

    public function listeMaintenanceEnCours(){
        $maintenance = new Maintenance();
        $listeMaintenance = $maintenance->getListeMaintenanceEnCours();
        return view("maintenance/liste_maintenance_en_cours", compact('listeMaintenance'));
    }

    public function listeMaintenanceTerminer(){
        $maintenance = new Maintenance();
        $listeMaintenance = $maintenance->getListeMaintenanceTerminer();
        return view("maintenance/liste_maintenance_terminer", compact('listeMaintenance'));
    }

    public function terminerMaintenanceForm(Request $request){
        $id_maintenance = $request->get('id_maintenance');
        $id_immobilisation = $request->get('id_immobilisation');
        return view("maintenance/terminer_maintenance", compact('id_maintenance', 'id_immobilisation'));
    }

    public function terminerMaintenance(Request $request){
        $id_maintenance = $request->get('id_maintenance');
        $fin = $request->get('fin');
        $id_immobilisation = $request->get('id_immobilisation');

        $maintenance = new Maintenance();
        $maintenance->updateMaintenance($id_maintenance, $fin, "EE000002");

        // $immobilisation_reception = new Immobilisation_reception();
        // $immobilisation_reception->updateImmobilisation($id_immobilisation, $fin);

        $immobilisation = (new Immobilisation_reception())->getOneImmobilisation($id_immobilisation);
        $pv_reception = (new Pv_Reception(id: $immobilisation->id_pv_reception))->getReception();

        $pv_reception_controller = new Pv_Reception_controller();

        $mockRequestData = [
            "bonCommande" => "null",
            "idArticle" => $pv_reception->id_article,
            "categorie" => $pv_reception->id_categorie
        ];

        // Create a mock request object
        $requestData = new Request([], $mockRequestData);

        $view = $pv_reception_controller->create_pv_reception($requestData);

        return $view;
        // return redirect()->route('liste_maintenance_terminer');
    }
    
}