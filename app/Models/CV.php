<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class CV extends Model
{
    public $id;
    public $idClient;
    public $idBesoin;
    public $idDiplome;
    public $experiences;
    public $idMatrimoniale;
    public $idVille;

    public function __construct($idClient = "",  $idBesoin = "", $idDiplome = "", $experience = "", $idSituation = "", $idVille = "") {
        $this->idClient = $idClient;
        $this->idBesoin = $idBesoin;
        $this->idDiplome = $idDiplome;
        $this->experiences = $experience;
        $this->idMatrimoniale = $idSituation;
        $this->idVille = $idVille;
    }

    public function insert() {
        try {
            $requete = "insert into cv(idclient, idbesoin, iddiplome, experiences, idmatrimoniale, idville) values ( ".$this->idClient ."," . $this->idBesoin . "," . $this->idDiplome . "," . $this->experiences . "," . $this->idMatrimoniale . "," . $this->idVille . ")";
            DB::insert($requete);
            // Obtenez l'ID généré automatiquement
            $dernierCVId = DB::getPdo()->lastInsertId();

            // Utilisez l'ID pour récupérer le besoin complet
            $dernierCV = DB::table('cv')->find($dernierCVId);

            Session::put('dernierCV', $dernierCV);
            // var_dump($dernierCV);


        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function getUn_Cv_Par_Id($id) {
        $requette = "select * from Cv where id = " . $id;
        $reponse = DB::select($requette);
        $cv = null;
        if(count($reponse) > 0) {
            $cv = new CV();
            $cv->id = $reponse[0]->id;
            $cv->idClient = $reponse[0]->idclient;
            $cv->idBesoin = $reponse[0]->idbesoin;
            $cv->idDiplome = $reponse[0]->iddiplome;
            $cv->experiences = $reponse[0]->experiences;
            $cv->idMatrimoniale = $reponse[0]->idmatrimoniale;
            $cv->idVille = $reponse[0]->idville;
        }
        return $cv;
    }
}
