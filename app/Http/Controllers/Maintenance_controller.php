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
        $designation = $request->get('designation');
        $etat_entretien = "EE000001";

        $maintenance = new Maintenance(id_immobilisation_reception: $immobilisation, id_type_entretien: $type, debut_maintenance: $debut, id_etat_entretien: $etat_entretien, designation: $description);
        $maitenance->insert();

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
        $maitenance->updateMaintenance($id_maintenance, $fin, "EE000002");

        $immobilisation_reception = new Immobilisation_reception();
        $immobilisation_reception->updateImmobilisation($id_immobilisation, $fin);

        return redirect()->route('liste_maintenance_terminer');
    }
    
}