<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Service extends Model
{
    public $id;
    public $type;

    public function insertService($type) {
        try {
            $requete = "insert into service(type) values ('".$type."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Service: " . $e->getMessage());
        }    
    }

    public function getUneService($id) {
        $requette = "select * from Service where id = " . $id;
        $reponse = DB::select($requette);
        $service = null;
        if(count($reponse) > 0) {
            $service = new Service();
            $service->id = $reponse[0]->id;
            $service->type = $reponse[0]->type;
        }
        return $service;
    }

    public function getListeServices() {
        $requette = "select * from service";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $service = new Service();
                $service->id = $resultat->id;
                $service->type = $resultat->type;
                $liste[] = $service;
            }
        }
        return $liste;
    }
}
