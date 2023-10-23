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

    // public function __construct($idClient,  $idBesoin, $idDiplome, $experience, $idSituation, $idVille) {
    //     $this->idClient = $idClient;
    //     $this->idBesoin = $idBesoin;
    //     $this->idDiplome = $idDiplome;
    //     $this->experiences = $experience;
    //     $this->idMatrimoniale = $idSituation;
    //     $this->idVille = $idVille;
    // }

    public function insert($idClient, $idBesoin, $idDiplome, $experiences,$idMatrimoniale,  $idVille) {
        try {
            $requete = "insert into cv(idclient, idbesoin, iddiplome, experiences, idmatrimoniale, idville) values ( ".$idClient ."," . $idBesoin . "," . $idDiplome . "," . $experiences . "," . $idMatrimoniale . "," . $idVille . ")";
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

    public function selectCV(){
        $query = "select * from cv";
        $rs = DB::select($query);
        return $rs;
    }

}
