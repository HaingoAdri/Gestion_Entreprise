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

    public function index(Request $request){

        $date = $request->get('date');
        $bon_commande = (new BonCommande(id: $request->get('idBonCommande')))->getDonneesUnCommande();
        $details_proformat = (new Proformat())->getDonnees; //// eto za zaoooo
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

    public function show_pv_de_reception(){
        $bon_commande_en_cours = (new BonCommande())->getListeEnCours();
        return view("immobilisation/pv_de_reception_form", compact("bon_commande_en_cours"));
    }

    public function restesArticlesAVAliderPourCeBonCommande($numero, $bonCommande){
        $resultat = array();

        $listeProformat = $bonCommande->getDetailsBonCommande();
        $dansBonReception = (new BonReception(id_bon_commande: $numero))->getDetailsBonReceptionValiderPourUnBonCommande();

        $idArticles = [];
        foreach ($dansBonReception as $objet) {
            $idArticles[] = $objet->id_article;
        }

        for ($i=0; $i < count($listeProformat) - 1; $i++) {
            if(count($idArticles) > 0){
                if(!in_array($listeProformat[$i]->idArticle, $idArticles)){
                    echo "Bebeeeeeee ".$listeProformat[$i]->idArticle."\n";
                    $resultat[] = $listeProformat[$i];
                }
            }else{
                return $listeProformat;
            }
        }

        $resultat[] = $listeProformat[count($listeProformat)-1];

        // var_dump($resultat);
        return $resultat;
    }

    public function create_pv_de_reception(Request $request){
        $resultat = array();
        $resultat["date"] = $request->input('date');
        $resultat["lieu"] = $request->input('lieu');
        $resultat["numero"] = $request->input('numero');

        $bonCommande = new BonCommande(id: $resultat["numero"]);
        $bonCommande = $bonCommande->getDonneesUnCommande();
        $listeProformat = $this->restesArticlesAVAliderPourCeBonCommande($resultat["numero"], $bonCommande);

        // var_dump($listeProformat);

        return view("bon/bon_de_reception", compact("resultat", "bonCommande","listeProformat"));
    }
    

}
