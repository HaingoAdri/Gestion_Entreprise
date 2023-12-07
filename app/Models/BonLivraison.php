<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class BonLivraison extends Model
{
    public $id;
    public $lieu;
    public $date;
    public $id_bon_commande;
    public $id_recepteur;
    public $livreur;
    public $etat;

    public function __construct($id = "", $lieu = "", $date = "", $id_bon_commande = "",  $id_recepteur = "", $Livreur = "", $etat = "") {
        $this->id = $id;
        $this->date = $date;
        $this->idPayement = $idPayement;
        $this->delaiLivarison = $delaiLivarison;
        $this->idProformat = $idProformat;
        $this->etat = $etat;
    }

    public function insertBonLivraison() {
        try {
            $requete = "insert into bon_livraison (id, date, idPayement, delaiLivarison, etat) values ('$this->id', '$this->date', $this->idPayement, '$this->delaiLivarison', '$this->etat')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau bon de commande: ".$e->getMessage());
        }    
    }

    public function insertDetailsCommande() {
        try {
            $requete = "insert into details_bon_commande (idboncommande, idproformat, etat) values ('$this->id','$this->idProformat', '$this->etat')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer le details du bon de commande: ".$e->getMessage());
        }    
    }

    public function updateEtat() {
        try {
            $requete = "update bon_commande set etat = $this->etat where id = '$this->id'";
            DB::update($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible de changer l'etat du bon de commande: ".$e->getMessage());
        }    
    }

    public function getNextIDCommande() {
        $requette = "select nextID('seqBonCommande', 'BC', 10);";
        $reponse = DB::select($requette);
        $id = "";
        if(count($reponse) > 0){
            $id = $reponse[0]->nextid;
        }
        return $id;
    }

    public function getDonneesUnCommande() {
        $requette = "select * from bon_commande where id = '$this->id'";
        $reponse = DB::select($requette);
        $bonCommande = null;
        if(count($reponse) > 0){
            $bonCommande = new BonCommande(id: $reponse[0]->id, date: $reponse[0]->date, idPayement: $reponse[0]->idpayement, delaiLivarison: $reponse[0]->delailivarison);
        }
        return $bonCommande;
    }

    public function getDetailsBonCommande() {
        $liste = (new Proformat())->getListeProformatParIdBonCommande($this->id);

        if(count($liste) > 0)
            $this->nom = ((new Demande(idDemande: $liste[0]->idDemande))->getDonneesUnDemande())->nom;
        return $liste;
    }

    public function getModePayement() {
        if($this->idPayement == 5)
            return "Virement";
        else if($this->idPayement == 10)
            return "Cheque";
    }

    public function getIdDemande() {
        $requette = "select * from details_bon_commande where idBonCommande = '$this->id' and etat = 8";
        $reponse = DB::select($requette);
        $idDemande = null;
        if(count($reponse) > 0){
            $idProformat = $reponse[0]->idproformat;
            $proformat = (new Proformat(id: $idProformat))->getUnProformat();
            $idDemande = $proformat->idDemande;
        }
        return $idDemande;
    }

    public function getListeEnAttente() {
        $requette = "select * from liste_bon_commande_en_attente where etat < 37 order by date desc";
        if($this->etat != "")
            $requette = "select * from liste_bon_commande_en_attente where etat = $this->etat order by date desc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $bonCommande = new BonCommande(id: $resultat->id, date: $resultat->date, idPayement: $resultat->idpayement, delaiLivarison: $resultat->delailivarison, etat: $resultat->etat);
                $idDemande = $bonCommande->getIdDemande();
                $demande = (new Demande(idDemande: $idDemande))->getDonneesUnDemande();
                $bonCommande->nom = $demande->nom;
                $liste[] = $bonCommande;
            }
        }
        return $liste;
    }

    public function getEtat() {
        $etats = (new Etats(id_e: $this->etat))->getDonnes_Un_Etat();
        return $etats->nom_etats;
    }

    public function valider() {
        $this->updateEtat();
        $idDemande = $this->getIdDemande();
        (new BesoinAchat(etat: $this->etat))->updateEtatParIdDemande($idDemande);
    }

    public function getListeEnCours() {
        $requette = "select * from liste_bon_commande_en_cours order by date desc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $bonCommande = new BonCommande(id: $resultat->id, date: $resultat->date, idPayement: $resultat->idpayement, delaiLivarison: $resultat->delailivarison, etat: $resultat->etat);
                $idDemande = $bonCommande->getIdDemande();
                $demande = (new Demande(idDemande: $idDemande))->getDonneesUnDemande();
                $bonCommande->nom = $demande->nom;
                $liste[] = $bonCommande;
            }
        }
        return $liste;
    }

}
