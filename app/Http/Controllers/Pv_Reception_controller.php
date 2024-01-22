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

use Illuminate\Support\Facades\Session;

class Pv_Reception_controller extends Controller
{

    public function index(){
        $compte = new Compte();
        $listeCompte = $compte->getListeTypeImmobilisation();

        $lieu = new Lieu();
        $listeLieu = $lieu->getListeLieu();

        $etat = new Etat_immobilisation();
        $etats = $etat->getAllEtats();

        $livreur = new Livreur();
        $listeLivreur = $livreur->getListeLivreur();

        return view("immobilisation/pv_reception", compact('listeCompte', 'listeLieu', 'etats', 'listeLivreur'));
    }

    
    public function insertPvReception(Request $request){
        $date = $request->get('date');
        $lieu = $request->get('lieu');
        $compte = $request->get('compte');
        $etat_immobilisation = $request->get('etat');
        $id_recepteur = Session::get('administrateur_rh')->id;
        $id_livreur = $request->get('livreur');
        
        $pv_reception = new Pv_Reception("", $date, "", $etat_immobilisation, $id_recepteur, $id_livreur);
        $lieu->insert();
        
        return redirect()->route('ajout_lieu_immobilisation');
    }
    
    public function nouveauLieu(){
        $lieu = new Lieu();
        $listeLieu = $lieu->getListeLieu();
        return view("immobilisation/lieu", compact('listeLieu'));
    }

    public function insertLieu(Request $request){
        $code = $request->get('code');
        $nom = $request->get('nom');

        $lieu = new Lieu($code, $nom, 32);
        $lieu->insert();

        return redirect()->route('ajout_lieu_immobilisation');
    }

    public function nouvelleEtat(){
        $etat = new Etat_immobilisation();
        $listeEtats = $etat->getAllEtats();
        return view("immobilisation/etat", compact('listeEtats'));
    }

    public function insertEtat(Request $request){
        $nom = $request->get('nom');

        $etat_immobilisation = new Etat_immobiisation(nom: $nom);
        $etat_immobilisation->insert();

        return redirect()->route('ajout_etat_immobilisation');
    }

    public function nouveauLivreur(){
        $fournisseur = new Fournisseur();
        $listeFournisseur = $fournisseur->getListeFournisseur();

        $livreur = new Livreur();
        $listeLivreur = $livreur->getListeLivreur();

        return view("immobilisation/livreur", compact('listeFournisseur', 'listeLivreur'));
    }

    public function insertLivreur(Request $request){
        $nom = $request->get('nom');
        $contact = $request->get('contact');
        $fournisseur = $request->get('fournisseur');

        $livreur = new Livreur(0, $nom, $contact, $fournisseur);
        $livreur->insert();

        return redirect()->route('ajout_livreur_immobilisation');
    }


    // public function voirCaisseMagasin(Request $request) {
    //     $idMagasin = $request->get('idMagasin');
    //     $magasin = new Magasin();
    //     $listeMagasin = $magasin->getListeMagasin();
    //     if($idMagasin != "") {
    //         $magasin->id = $idMagasin;
    //         $magasin = $magasin->getMagasin();
    //     } else {
    //         $magasin = null;
    //     }
    //     return view("magasin/caisse_magasin", compact('listeMagasin', 'magasin'));
    // }

    // public function nouveauCaisseMagasin(Request $request) {
    //     $idMagasin = $request->get('idMagasin');
    //     $idCaisse = $request->get('idCaisse');
    //     $caisse = new Caisse(id: $idCaisse);
    //     if(!$caisse->caisseExisteDeja()) {
    //         return redirect()->route('voirCaisseMagasin', ['idMagasin' => $idMagasin])->with('erreur', "Le numero de caisse: $idCaisse n'existe pas!");
    //     }
    //     if($caisse->caisseAppartientMagasin()) {
    //         return redirect()->route('voirCaisseMagasin', ['idMagasin' => $idMagasin])->with('erreur', "Le numero de caisse: $idCaisse est deja occupe!");
    //     }
    //     (new Magasin(id: $idMagasin))->ajoutCaisse($idCaisse);
    //     return redirect()->route('voirCaisseMagasin', ['idMagasin' => $idMagasin]);

    // }
    

}
