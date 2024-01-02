<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Sortie_Vente extends Model
{
    public $id;
    public $sortieDetails;
    public $prix_unitaire;
    public $tva;
    public $prix_TTC;
    public $montant_Total;
    public $lieu_vente;
    public $numero;

    public function __construct($id="",$sortieDetails="",$prix_unitaire="",$tva="",$prix_TTC="",$montant="",$lieu_vente="",$numero=""){
        $this->id = $id;
        $this->sortieDetails = $sortieDetails;
        $this->prix_unitaire = $prix_unitaire;
        $this->tva = $tva;
        $this->prix_TTC = $prix_TTC;
        $this->montant_Total = $montant;
        $this->lieu_vente = $lieu_vente;
        $this->numero = $numero;
    }

    public function insertSortieVente(){
        $sql = "insert into sortie_vente(lieu_vente,details_sortie,prix_unitaire,tva_origine,numero_caisse) values ('".$this->lieu_vente."','".$this->sortieDetails."',".$this->prix_unitaire.",".$this->tva.", '".$this->numero."')";
        $insert = DB::insert($sql);
        return $insert;
    }

    public function getSortieVente(){
        $sql = "select * from V_Vente";
        $reponse = DB::select($sql);
        return $reponse;
    }

    
}