<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Module extends Model
{
    public $id;
    public $type;

    public function getListeModules() {
        $requette = "select * from module order by type asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $module = new Module();
                $module->id = $resultat->id;
                $module->type = $resultat->type;
                $liste[] = $module;
            }
        }
        return $liste;
    }

    public function getUneModule($id) {
        $requette = "select * from module where id = " . $id;
        $reponse = DB::select($requette);
        $module = null;
        if(count($reponse) > 0) {
            $module = new Module();
            $module->id = $reponse[0]->id;
            $module->type = $reponse[0]->type;
        }
        return $module;
    }
}
