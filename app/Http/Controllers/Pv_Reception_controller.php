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

use Illuminate\Support\Facades\Session;

class Pv_Reception_controller extends Controller
{
    
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

        $etat_immobilisation = new Etat_immobilisation(nom: $nom);
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

    public function show_list_bon_commande(){
        $bonCommande = new BonCommande();
        $listeBonCommande = $bonCommande->getListeEnAttenteImmobilisation();
        // $listeBonCommande = array();
        return view("immobilisation/liste_bon_commande", compact("listeBonCommande"));
    }

    public function show_list_proformat(Request $request){
        $date = $request->get("date");
        $lieu = $request->get("lieu");
        // $numeroBonCommande = $request->get("numero");
        $numeroBonCommande = "BC00000012";
        $liste_details_bon_commande = (new BonCommande(id: $numeroBonCommande))->getDetailsBonCommande();
        $donnees = (new BonCommande(id: $numeroBonCommande))->getDonneesUnCommande();
        // $listeDescription = array();

        // for($i=0; $i<count($bonCommande); $i++){
        //     $description_immobilisation = (new Compte(id: $bonCommande[$i]->idArticle))->getListeDescription();
        //     $listeDescription[] = $description_immobilisation;
        // }

        // var_dump($bonCommande);

        // echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ";

        // var_dump($listeDescription);
        return view("immobilisation/liste_proformat", compact("date", "lieu", "liste_details_bon_commande", "donnees"));
    }

    public function create_pv_reception(Request $request){
        $numero = $request->get("bonCommande");
        $article = (new Article(id: $request->get("idArticle")))->getDonneesUnArticle();
        $compte = (new Compte(id: $request->get("idArticle")))->getCompte();
        $listeDescription = (new Compte(id: $request->get("idArticle")))->getListeDescription();

        $etat = new Etat_immobilisation();
        $listeEtats = $etat->getAllEtats();
        $listeAmmortissements = $etat->getAllAmmortissement();

        $lieu = new Lieu();
        $listeLieu = $lieu->getListeLieu();

        $livreur = new Livreur();
        $listeLivreur = $livreur->getListeLivreur();

        return view("immobilisation/pv_reception_form", compact("numero", "article", "compte", "listeDescription", "listeEtats", "listeAmmortissements", "listeLieu", "listeLivreur"));
    }

    public function insert_pv_reception(Request $request){
        
        $date = $request->get("date");
        $lieu = $request->get("lieu");
        $etat = $request->get("etat");
        $ammortissement = $request->get("ammortissement");
        $taux = $request->get("taux");
        $recepteur = Session::get('administrateur_rh')->id;
        $livreur = $request->get("livreur");
        $numero_bon_commande = $request->get("numero_bon");
        $id_compte = $request->get("id_compte");
        
        $pv_reception = new Pv_Reception(date: $date, id_etat_immobilisation: $etat, id_type_ammortissement: $ammortissement, taux: $taux, id_receptionneur: $recepteur, id_livreur: $livreur, id_bon_commande: $numero_bon_commande);
        
        $lastID = $pv_reception->codification($lieu, $id_compte);

        $listeDescription = (new Compte(id: $id_compte))->getListeDescription();

        for($i=0; $i< count($listeDescription); $i++){
            $information = $request->get("".$listeDescription[$i]->description."_".$listeDescription[$i]->idDescription);
            $details = new Details_Pv_Reception($lastID, $listeDescription[$i]->idDescription, $information);
            $details->insert();
        }

        return redirect()->route('show_list_bon_commande');
    }
    
}
